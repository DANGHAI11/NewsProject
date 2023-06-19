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

    public function login(array $data): bool
    {
        $remember = !empty($data['remember']);
        $arrLogin = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        return Auth::attempt($arrLogin, $remember);
    }

    public function register(array $data): bool
    {
        $data['role'] = $this->user::ROLE_USER;
        $data['status'] = $this->user::STATUS_INACTIVE;
        $data['token_verify_email'] = Str::random(64);
        if (User::create($data)) {
            Mail::to($data['email'])->send(new VerifyMail($data));

            return true;
        }

        return false;
    }

    public function forgotPassword(array $data): bool
    {
        $token = Str::random(20);
        $user = User::where(['email' => $data['email']])->first();
        if ($user) {
            if ($user->update(['reset_password_token' => $token])) {
                Mail::to($data['email'])->send(new ForgotPasswordMail($user, $token));

                return true;
            }
        }

        return false;
    }

    public function changePassword(string $token): bool
    {
        $password = Str::random(12);
        $user = User::where('reset_password_token', $token)->first();
        if ($user) {
            if ($user->update(['password' => $password])) {
                Mail::to($user['email'])->send(new ChangePasswordMail($password));

                return true;
            }
        }

        return false;
    }

    public function verifyAccount(string $token): string
    {
        $user = User::where(['token_verify_email' => $token, 'status' => $this->user::STATUS_INACTIVE])->first();
        $message = __('message.already_email_verify');
        if (!empty($user)) {
            $user->update(['email_verified_at' => now(), 'status' => $this->user::STATUS_ACTIVE]);
            $message = __('message.success_email_verify');
        }

        return $message;
    }
}
