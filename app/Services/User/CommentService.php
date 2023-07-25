<?php

namespace App\Services\User;

use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function getAllComment(int $postId, array $dataSearch = []): LengthAwarePaginator|int
    {
        $query = Comment::where('post_id', $postId)->with('user');
        $order = $dataSearch['order'] ?? 'desc';
        $query->orderBy('created_at', $order);
        if (isset($dataSearch['count'])) {
            return $query->count();
        }

        return $query->paginate(Post::HOME_LIMIT)->withQueryString($dataSearch);
    }

    public function createComment(array $data = []): Comment|bool
    {
        try {
            $data['user_id'] = Auth::id();
            Comment::create($data);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function updateComment(array $data, object $comment): bool
    {
        try {
            return $comment->update($data);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function deleteComment(object $comment): bool
    {
        try {
            return $comment->delete();
        } catch (Exception $ex) {
            return false;
        }
    }
}
