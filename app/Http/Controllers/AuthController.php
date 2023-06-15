<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
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
    public function login(AuthRequest $request)
    {
        $data = $request->all();
        $model = $this->authService->login($data);
        if ($model) return redirect()->route('home');
        return back()->with("error", __('message.error_login'));
    }
    public function register(AuthRequest $request)
    {
        $token = Str::random(64);
        $data = $request->all();
        $model = $this->authService->register($data, $token);
        if ($model) return redirect()->route('login')->with('success', __('message.success_register'));
        return back()->with('error', __('message.error_register'));
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
    public function verifyAccount($token)
    {
        $user = User::where('token_verify_email', $token)->first();
        $message = __('message.email_identified');
        if (isset($user)) {
            if (!$user->email_verified_at) {
                $user->email_verified_at = time();
                $user->status = 1;
                $user->save();
                $message = __('message.success_email_verify');
            } else {
                $message = __('message.already_email_verify');
            }
        }
        return redirect()->route('login')->with('success', $message);
    }
    public function forgotPassword(Request $request)
    {
        $token = Str::random(20);
        $data = $request->all();
        $model = $this->authService->forgotPassword($data, $token);
        if($model) return redirect()->route('login')->with('success', __('message.forgot_email'));
        return back()->with('error', __('message.error_forgot_email'));

    }
    public function changePassword($token)
    {
        $model = $this->authService->changePassword($token);
        if ($model) return redirect()->route('login')->with('success', __('message.has_been_password'));
        return redirect()->route('login')->with('error', __('message.error_forgot_email'));
    }
}
