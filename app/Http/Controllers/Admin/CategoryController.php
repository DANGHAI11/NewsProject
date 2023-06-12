<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use App\Services\Admin\PostService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $dataSearch = [
            'name' => $request->name,
            'limit_page' => $request->limit_page,
        ];

        return view('admin.category.index', [
            'categories' => $this->categoryService->getAllCategory($dataSearch),
            'pageLimit' => PostService::getPageLimit(),
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        if ($this->categoryService->store($request->all())) {
            return redirect()->route('admin.category.index')->with('success', __('admin.create_category_success'));
        }

        return redirect()->route('admin.category.index')->with('error', __('admin.create_category_error'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        if ($this->categoryService->update($request->all(), $category)) {
            return redirect()->route('admin.category.index')->with('success', __('admin.update_category_success'));
        }

        return redirect()->route('admin.category.index')->with('success', __('admin.update_category_error'));
    }

    public function delete(Category $category)
    {
        if ($this->categoryService->delete($category)) {
            return redirect()->route('admin.category.index')->with('success', __('admin.delete_category_success'));
        }

        return redirect()->route('admin.category.index')->with('error', __('admin.delete_category_error'));
    }
}
