<?php

namespace App\Services;

use App\Mail\ChangePasswordMail;
use App\Mail\ForgotPasswordMail;
use App\Mail\VerifyMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login($data)
    {
        isset($data['remember']) && $data['remember'] ? $remember = true : $remember = false;
        $model  = [
            'email' => $data['email'],
            'password' => $data['password'],
            'status' =>  $this->user::STATUS_ACTIVE
        ];
        if (Auth::attempt($model, $remember)) {
            return true;
        }
        return false;
    }

    public function register($data, $token)
    {
        $data['role'] = User::ROLE_USER;
        $data['status'] = User::STATUS_INACTIVE;
        $data['token_verify_email'] = $token;
        if (User::create($data)) {
            Mail::to($data['email'])->send(new VerifyMail($data));
            return true;
        }
        return false;
    }

    public function forgotPassword($data, $token)
    {
        $user = User::where(['email' => $data['email'], 'status' => 1])->first();
        if ($user) {
            $user->reset_password_token = $token;
            if ($user->save()) {
                Mail::to($data['email'])->send(new ForgotPasswordMail($user, $token));
                return true;
            }
        }
        return false;
    }

    public function changePassword($token)
    {
        $user = User::where('reset_password_token', $token)->first();
        $password = Str::random(12);
        $user->password = $password;
        if ($user->save()) {
            Mail::to($user['email'])->send(new ChangePasswordMail($password));
            return true;
        }
        return true;
    }
}
