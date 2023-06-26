<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $categoryService;

    protected $postService;

    /**
     * PostController constructor.
     * @param CategoryService $categoryService
     * @param PostService $postService
     */
    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dataSearch = [
            'category' => $request->route('category_id'),
            'title' => isset($request->all()['title']) ? $request->all()['title'] : null,
            'user_id' => \Route::is('myblog') ? true : false,
        ];

        $posts = $this->postService->getAll($dataSearch);
        $categories = $this->categoryService->getAllCategories();

        return view('post.index', [
            'posts' => $posts,
            'categories' => $categories,
            'category' => $dataSearch['category'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $result = $this->postService->createPost($request->all());
        if ($result) {
            return redirect()->route('post.create')->with('success', __('message.success_create_post'));
        }

        return redirect()->route('post.create')->with('error', __('message.error_create_post'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = $this->postService->getFirst($id);
        if ($post) {
            $postRelated = $this->postService->getRelated($post->categiory_id, $id);

            return view('post.detail', [
                'postDetail' => $post,
                'postRelated' => $postRelated,
                'id' => $id,
            ]);
        }

        return redirect()->route('home')->with('error', __('message.post_does_exist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $postEdit = $this->postService->getFirst($id);
        $categories = $this->categoryService->getAllCategories();

        return view('post.edit', [
            'postEdit' => $postEdit,
            'categories' => $categories,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $idPost = $request->route('id');
        $result = $this->postService->updatePost($data, $idPost);
        if ($result) {
            return redirect()->back()->with('success', 'Update thành công');
        }

        return redirect()->back()->with('error', 'Update không thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->all()['id'];
        $result = $this->postService->deletePost($id);
        if ($result) {
            return redirect()->route('home')->with('success', __('message.success_delete_post'));
        }

        return redirect()->back()->with('error', __('message.error_delete_post'));
    }
}
