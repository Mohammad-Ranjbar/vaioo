<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'mobile' => ['required','starts_with:09','numeric','digits:11','exists:users,mobile'],
            'password' => ['required','min:6'],
        ];
    }
}
