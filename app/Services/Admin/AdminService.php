<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class AdminService
{
    public function getTotalData(): array
    {
        $totalUser = User::count();
        $totalComment = Comment::count();
        $totalPost = Post::count();
        $totalCategory = Category::count();
        return [
            'totalUser' => $totalUser,
            'totalComment' => $totalComment,
            'totalPost' => $totalPost,
            'totalCategory' => $totalCategory,
        ];
    }
}
