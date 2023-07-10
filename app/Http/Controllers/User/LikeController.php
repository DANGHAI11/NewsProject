<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Services\User\LikeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

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
            $statusLike = $this->likeService->statusLike($post->id, Auth::user());
            $totalLike = $this->likeService->totalLikePost($post);
            return Response::json([
                'totalLike' => $totalLike,
                'statusLike' => $statusLike,
            ], 200);
        }
    }
}
