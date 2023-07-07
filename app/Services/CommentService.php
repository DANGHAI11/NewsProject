<?php

namespace App\Services;

use App\Models\Comment;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function getAllComment($post_id): Collection
    {
        $data = Comment::where('post_id', $post_id)->with(['post', 'user'])->orderBy('created_at', 'desc')->get();

        return $data;
    }

    public function createComment(array $data = [], object $post): bool
    {
        try {
            $data['user_id'] = Auth::id();
            $data['post_id'] = $post->id;
            Comment::create($data);

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function updateComment(array $data = [], object $comment): bool
    {
        try {
            return $comment->update(
                ['content' => $data['content']]
            );
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
