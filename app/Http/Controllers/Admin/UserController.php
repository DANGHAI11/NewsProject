<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\User;
use App\Services\Admin\PostService;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $dataSearch = [
            'name' => $request->name,
            'status' => $request->status,
            'limit_page' => $request->limit_page,
            'role' => $request->role
        ];

        return view('admin.user.index', [
            'users' => $this->userService->getAll($dataSearch),
            'pageLimit' => PostService::getPageLimit()
        ]);
    }

    public function updateStatus(User $user)
    {
        if ($this->userService->updateStatus($user)) {
            return redirect()->back();
        }

        return redirect()->route('admin.user.index')->with('error', __('admin.active_status_error'));
    }

    public function updateStatusAll()
    {
        if ($this->userService->updateStatusAll()) {
            return redirect()->route('admin.user.index')->with('success', __('admin.active_all_status_success'));
        }

        return redirect()->route('admin.user.index')->with('error', __('admin.active_all_status_error'));
    }

    public function getViewUpdate(User $user)
    {
        $htmlProfile = view('admin.partials.updateProfile', ['user' => $user])->render();

        return Response::json([
            'htmlProfile' => $htmlProfile,
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        if ($this->userService->updateProfile($request->all(), $user)) {
            return redirect()->route('admin.user.index')->with('success', __('profile.update_profile_success'));
        }

        return redirect()->route('admin.user.index')->with('error', __('profile.update_profile_error'));
    }

    public function getViewDelete(User $user)
    {
        $htmlDelete = view('admin.partials.popupDelete', [
                            'data' => ['user' => $user],
                            'url' => 'admin.user.delete'
                        ])->render();

        return Response::json([
            'htmlDelete' => $htmlDelete,
        ]);
    }

    public function delete(User $user)
    {
        if ($user->id !== Auth::id()) {
            if ($this->userService->delete($user)) {
                return redirect()->route('admin.user.index')->with('success', __('profile.delete_profile_success'));
            }

            return redirect()->route('admin.user.index')->with('error', __('admin.do_not_delete'));
        }

        return redirect()->route('admin.user.index')->with('error', __('profile.delete_profile_error'));
    }
}
