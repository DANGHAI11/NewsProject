<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('checkStatus')->only('login', 'forgotPassword');
        $this->authService = $authService;
    }

    public function viewLogin()
    {
        return view('auth.login');
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function viewForgotPassword()
    {
        return view('auth.forgot_password');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->all();
        $result = $this->authService->login($data);
        if ($result) {
            return redirect()->route('home');
        }

        return back()->with('error', __('message.error_login'));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $result = $this->authService->register($data);
        if ($result) {
            return redirect()->route('login')->with('success', __('message.success_register'));
        }

        return back()->with('error', __('message.error_register'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function verifyAccount($token)
    {
        $message = $this->authService->verifyAccount($token);

        return redirect()->route('login')->with('success', $message);
    }

    public function forgotPassword(Request $request)
    {
        $data = $request->all();
        $result = $this->authService->forgotPassword($data);
        if ($result) {
            return redirect()->route('login')->with('success', __('message.forgot_email'));
        }

        return back()->with('error', __('message.error_forgot_email'));
    }

    public function changePassword($token)
    {
        $result = $this->authService->changePassword($token);
        if ($result) {
            return redirect()->route('login')->with('success', __('message.has_been_password'));
        }

        return redirect()->route('login')->with('error', __('message.error_forgot_email'));
    }
}
