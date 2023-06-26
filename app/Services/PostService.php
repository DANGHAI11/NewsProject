<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
    protected $post;

    /**
     * PostService constructor.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll(array $arrSearch = []): LengthAwarePaginator
    {
        $query = $this->post::active();

        if (isset($arrSearch['user_id'])) {
            $query->where('user_id', Auth::id());
        }
        if (isset($arrSearch['category'])) {
            $query->where('categiory_id', $arrSearch['category']);
        }
        if (isset($arrSearch['title'])) {
            $query->where('title', 'LIKE', '%' . $arrSearch['title'] . '%');
        }
        $query->with('user');

        return $query->paginate($this->post::HOME_LIMIT);
    }

    public function getRelated(Post $postDetail): Collection
    {
        $data = $this->post::where(['categiory_id' => $postDetail->categiory_id])
            ->active()
            ->where('id', '!=', $postDetail->id)
            ->with('user')
            ->inRandomOrder()
            ->limit($this->post::RELATED_LIMIT)
            ->get();

        return $data;
    }

    public function createPost(array $data = []): bool
    {
        try {
            $data['user_id'] = Auth::id();
            $data['image'] = $this->getNameImage($data['image']);
            $this->post::create($data);

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
                'categiory_id' => $data['categiory_id'],
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
            Comment::where('post_id', $postDelete->id)->delete();
            return $postDelete->delete();
        } catch (Exception $ex) {
            return false;
        }
    }

    protected function getNameImage(object $image): string
    {
        $fileName = Storage::disk('public')->put('images', $image);

        return $fileName;
    }
}
