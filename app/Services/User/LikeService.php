<?php

namespace App\Services\User;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function totalLikePost(object $post): int
    {
        return $post->likes()->count();
    }

    public function statusLike(int $postId, object $user): User|Post|null
    {
        try {
            return $user->likes()->where('post_id', $postId)->first();
        } catch (Exception $ex) {
            return false;
        }
    }

    public function handleLike(int $postId): bool
    {
        try {
            $user = Auth::user();
            if ($this->statusLike($postId, $user)) {
                $user->likes()->detach($postId);
                return true;
            }

            $user->likes()->attach($postId);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
