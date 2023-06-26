<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    protected $user;

    /**
     * Create a new policy instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(User $user)
    {
        return $user->status === $this->user::STATUS_ACTIVE && $user->role === $this->user::ROLE_USER;
    }

    public function update(User $user, Post $post)
    {
        return ($user->role === $this->user::ROLE_ADMIN || $user->id === $post->user_id) && $user->status === $this->user::STATUS_ACTIVE;
    }

    public function delete(User $user, Post $post)
    {
        return ($user->role === $this->user::ROLE_ADMIN || $user->id === $post->user_id) && $user->status === $this->user::STATUS_ACTIVE;
    }
}
