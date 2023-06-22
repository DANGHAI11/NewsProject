<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll(): object|null
    {
        $data = $this->post::where(['status' => $this->post::STATUS_ACTIVE])
            ->with('user')
            ->limit($this->post::HOME_LIMIT)
            ->orderBy('updated_at')
            ->get();
        return $data;
    }

    public function getFirst(int $id = 0): object|null
    {
        $data = $this->post::where(['id' => $id])
            ->with('user')
            ->first();
        return $data;
    }

    public function getRelated(int $category_id = 0): object|null
    {
        $data = $this->post::where(['categiory_id' => $category_id])
            ->with('user')
            ->limit($this->post::RELATED_LIMIT)
            ->orderBy('updated_at')
            ->get();
        return $data;
    }

    public function createPost(array $data = []): bool
    {
        $image = $data['image'];
        $imageName = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $data['user_id'] = Auth::id();
        $data['image'] = $imageName;
        $result = $this->post::create($data);
        if ($result) {
            return true;
        }
        return false;
    }

    public function deletePost(int $id = 0): bool|null
    {
        $result = $this->post::where('id', $id)->delete();
        return $result;
    }
}
