<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getAllComment($post_id): Collection
    {
        $data = $this->comment::where('post_id', $post_id)->with(['post', 'user'])->get();

        return $data;
    }
}
