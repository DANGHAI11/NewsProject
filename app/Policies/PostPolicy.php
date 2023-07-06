<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function create(User $user)
    {
        return $user->status === User::STATUS_ACTIVE && $user->role === User::ROLE_USER;
    }

    public function update(User $user, Post $post)
    {
        return ($user->role === User::ROLE_ADMIN || $user->id === $post->user_id) && $user->status === User::STATUS_ACTIVE;
    }

    public function delete(User $user, Post $post)
    {
        return ($user->role === User::ROLE_ADMIN || $user->id === $post->user_id) && $user->status === User::STATUS_ACTIVE;
    }
}
