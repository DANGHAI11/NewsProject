<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function create(User $user)
    {
        return $user->status === User::STATUS_ACTIVE;
    }

    public function update(User $user, Comment $comment)
    {
        return $user->status === User::STATUS_ACTIVE && ($user->role === User::ROLE_ADMIN || $user->id === $comment->user_id);
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->status === User::STATUS_ACTIVE && ($user->role === User::ROLE_ADMIN || $user->id === $comment->user_id);
    }
}
