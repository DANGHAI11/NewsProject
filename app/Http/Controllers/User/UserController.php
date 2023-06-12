<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\User\CategoryService;
use App\Services\User\PostService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    protected $categoryService;

    protected $postService;

    public function __construct(
        UserService $userService,
        CategoryService $categoryService,
        PostService $postService
    ) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $this->authorize('index', User::class);

        $dataSearch = [
            'check_user' => true,
            'category' => $request->category,
            'title' => $request->title,
        ];

        return view('user.index', [
            'posts' => $this->postService->getAll($dataSearch),
            'categories' => $this->categoryService->getAllCategories(),
        ]);
    }

    public function edit()
    {
        $this->authorize('update', User::class);

        return view('user.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', User::class);
        if ($this->userService->update($request->all(), $user)) {
            return redirect()->back()->with('success', __('profile.update_profile_success'));
        }

        return redirect()->back()->with('error', __('profile.update_profile_error'));
    }

    public function delete(User $user)
    {
        $this->authorize('delete', User::class);
        if ($this->userService->delete($user)) {
            return redirect()->route('home')->with('success', __('profile.delete_profile_success'));
        }

        return redirect()->back()->with('error', __('profile.delete_profile_error'));
    }

    public function editPassword()
    {
        $this->authorize('updatePassword', User::class);

        return view('user.changePassword', [
            'user' => Auth::user(),
        ]);
    }

    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {
        $this->authorize('updatePassword', User::class);
        $result = $this->userService->updatePassword($request->all(), $user);
        return redirect()->back()->with($result['status'], $result['message']);
    }
}
