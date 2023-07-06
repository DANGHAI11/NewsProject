<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    public function getAllComment($post_id): Collection
    {
        $data = Comment::where('post_id', $post_id)->with(['post', 'user'])->get();

        return $data;
    }
}
