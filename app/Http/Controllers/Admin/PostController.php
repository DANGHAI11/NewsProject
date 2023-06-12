<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Admin\CategoryService;
use App\Services\Admin\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    protected $categoryService;

    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $dataSearch = [
            'title' => $request->title,
            'status' => $request->status,
            'limit_page' => $request->limit_page,
            'category' => $request->category,
            'id' => $request->id
        ];

        return view('admin.post.index', [
            'posts' => $this->postService->getAll($dataSearch),
            'pageLimit' => $this->postService->getPageLimit(),
            'categories' => $this->categoryService->getAllCategory([], true)
        ]);
    }

    public function approved(Post $post)
    {
        if ($this->postService->approved($post)) {
            return redirect()->back();
        }

        return redirect()->back()->with('error', __('admin.approved_error'));
    }

    public function approvedAll()
    {
        if ($this->postService->approvedAll()) {
            return redirect()->route('admin.post.index')->with('success', __('admin.approved_all_success'));
        }

        return redirect()->route('admin.post.index')->with('error', __('admin.approved_all_error'));
    }

    public function destroy(Post $post)
    {
        $result = $this->postService->deletePost($post);
        if ($result) {
            return redirect()->back()->with('success', __('message.success_delete_post'));
        }

        return redirect()->back()->with('error', __('message.error_delete_post'));
    }
}
