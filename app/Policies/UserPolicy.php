<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        return $user->status === User::STATUS_ACTIVE;
    }

    public function update(User $user)
    {
        return $user->status === User::STATUS_ACTIVE;
    }

    public function delete(User $user)
    {
        return $user->status === User::STATUS_ACTIVE;
    }

    public function updatePassword(User $user)
    {
        return $user->status === User::STATUS_ACTIVE;
    }
}
