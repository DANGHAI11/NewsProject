<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        if ($request->has('name'))
            return [
                'name' => 'required|string|max:255||min:2',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|same:confirm_password'
            ];
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
