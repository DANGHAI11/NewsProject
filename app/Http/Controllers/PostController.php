<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $categoryService;

    protected $post;

    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->categoryService = $categoryService;
        $this->post = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = $this->post->getAll();
        $categories = $this->categoryService->getAllCategories();
        $userRole = User::ROLE_ADMIN;
        return view('post.index', [
            'post' => $post,
            'categories' => $categories,
            'userRole' => $userRole
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        $userRole = User::ROLE_ADMIN;
        return view('post.create', [
            'categories' => $categories,
            'userRole' => $userRole
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $result = $this->post->createPost($request->all());
        if ($result) {
            return redirect()->route('post-create')->with('success', 'Tạo bài viết thành công.');
        }
        return redirect()->route('post-create')->with('error', 'Tạo bài viết không thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userRole = User::ROLE_ADMIN;
        $post = $this->post->getFirst($id);
        $postRelated = $this->post->getRelated($post->categiory_id);
        if ($post) {
            return view('post.detail', [
                'userRole' => $userRole,
                'postDetail' => $post,
                'postRelated' => $postRelated,
                'id' => $id
            ]);
        }
        return redirect()->route('home')->with('error','Bài viết không còn tồn tại');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->all()['id'];
        $result = $this->post->deletePost($id);
        if ($result) {
            return redirect()->route("home")->with('success', 'Xóa bài viết thành công.');
        }
        return redirect()->back()->with('error', 'Xóa bài viết không thành công.');
    }
}
