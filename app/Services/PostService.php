<?php

namespace App\Services;

use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PostService
{
    protected $post;

    /**
     * PostService constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll(array $arrSearch = []): LengthAwarePaginator|null
    {
        $query = $this->post::active();

        if ($arrSearch['user_id']) {
            $query->where('user_id', Auth::id());
        }
        if (isset($arrSearch['category']) && is_numeric($arrSearch['category'])) {
            $query->where('categiory_id', $arrSearch['category']);
        }
        if (isset($arrSearch['title'])) {
            $query->where('title', 'LIKE', '%' . $arrSearch['title'] . '%');
        }
        $query->with('user');

        return $query->paginate($this->post::HOME_LIMIT);
    }

    public function getFirst(int $id = 0): object|null
    {
        $data = $this->post::where(['id' => $id])
            ->with('user')
            ->first();

        return $data;
    }

    public function getRelated(int $category_id = 0, int $idPost): Collection|null
    {
        $data = $this->post::where(['categiory_id' => $category_id])
            ->active()
            ->where('id', '<>', $idPost)
            ->with('user')
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

    public function updatePost(array $data, $idPost): bool
    {
        try {
            if (isset($data['image'])) {
                $data['image'] = $this->getNameImage($data['image']);
            } else {
                $data['image'] = $this->post->find($idPost)->image;
            }

            return $this->post::where('id', $idPost)->update([
                'title' => $data['title'],
                'categiory_id' => $data['categiory_id'],
                'content' => $data['content'],
                'image' => $data['image'],
            ]);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function deletePost(int $id = 0): bool
    {
        try {
            return $this->post::where('id', $id)->delete();
        } catch (Exception $ex) {
            return false;
        }
    }

    protected function getNameImage(object $image): string
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        return $imageName;
    }
}
