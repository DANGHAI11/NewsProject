<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $categoryService;

    protected $postService;

    protected $commentService;

    /**
     * PostController constructor.
     */
    public function __construct(
        CategoryService $categoryService,
        PostService $postService,
        CommentService $commentService
    ) {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dataSearch = [
            'category' => $request->route('category_id'),
            'title' => isset($request->title) ? $request->title : null,
        ];

        return view('post.index', [
            'posts' => $this->postService->getAll($dataSearch),
            'categories' => $this->categoryService->getAllCategories(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('post.create', [
            'categories' => $this->categoryService->getAllCategories(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $this->authorize('create', Post::class);
        $result = $this->postService->createPost($request->all());
        if ($result) {
            return redirect()->route('post.create')->with('success', __('message.success_create_post'));
        }

        return redirect()->route('post.create')->with('error', __('message.error_create_post'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $postDetail)
    {
        if ($postDetail) {
            return view('post.detail', [
                'postDetail' => $postDetail,
                'postRelated' => $this->postService->getRelated($postDetail),
                'comments' => $this->commentService->getAllComment($postDetail->id),
            ]);
        }

        return redirect()->route('home')->with('error', __('message.post_does_exist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $postEdit)
    {
        $this->authorize('update', $postEdit);

        return view('post.edit', [
            'postEdit' => $postEdit,
            'categories' => $this->categoryService->getAllCategories(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $postUpdate)
    {
        $this->authorize('update', $postUpdate);
        $data = $request->all();
        $result = $this->postService->updatePost($data, $postUpdate);
        if ($result) {
            return redirect()->back()->with('success', __('message.update_success'));
        }

        return redirect()->back()->with('error', __('message.update_error'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $postDelete)
    {
        $this->authorize('delete', $postDelete);
        $result = $this->postService->deletePost($postDelete);
        if ($result) {
            return redirect()->route('home')->with('success', __('message.success_delete_post'));
        }

        return redirect()->back()->with('error', __('message.error_delete_post'));
    }
}
