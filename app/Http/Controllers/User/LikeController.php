<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\User\LikeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function like(Post $post)
    {
        if ($this->likeService->handleLike($post->id)) {
            $statusLike = $this->likeService->statusLike($post->id);
            $totalLike = $this->likeService->totalLikePost($post);

            return Response::json([
                'totalLike' => $totalLike,
                'statusLike' => $statusLike,
            ], 200);
        }
    }
}
