<?php

namespace App\Services\User;

use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function getAll(array $arrSearch = []): LengthAwarePaginator
    {
        $query = Post::active();

        if (isset($arrSearch['check_user'])) {
            $query->where('user_id', Auth::id());
        }

        if (isset($arrSearch['category'])) {
            $query->where('category_id', $arrSearch['category']);
        }

        if (isset($arrSearch['title'])) {
            $query->where('title', 'LIKE', '%' . $arrSearch['title'] . '%');
        }
        $query->with('user');

        return $query->paginate(Post::HOME_LIMIT)->withQueryString($arrSearch);
    }

    public function getRelated(Post $postDetail): Collection
    {
        $data = Post::where(['category_id' => $postDetail->category_id])
            ->active()
            ->where('id', '!=', $postDetail->id)
            ->with('user')
            ->inRandomOrder()
            ->limit(Post::RELATED_LIMIT)
            ->get();

        return $data;
    }

    public function createPost(array $data = []): bool
    {
        try {
            $data['user_id'] = Auth::id();
            $data['image'] = $this->getNameImage($data['image']);
            Post::create($data);

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function updatePost(array $data, object $postUpdate): bool
    {
        try {
            if (isset($data['image'])) {
                $data['image'] = $this->getNameImage($data['image']);
            } else {
                $data['image'] = $postUpdate->image;
            }

            return $postUpdate->update([
                'title' => $data['title'],
                'category_id' => $data['category_id'],
                'content' => $data['content'],
                'image' => $data['image'],
            ]);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function deletePost(object $postDelete): bool
    {
        try {
            DB::beginTransaction();
            Comment::where('post_id', $postDelete->id)->delete();
            $postDelete->likes()->detach();
            $postDelete->delete();
            DB::commit();

            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            return false;
        }
    }

    protected function getNameImage(object $image): string
    {
        $fileName = Storage::disk('public')->put('images', $image);

        return $fileName;
    }
}
