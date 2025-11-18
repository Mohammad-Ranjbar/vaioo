<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'mobile' => ['required','starts_with:09','numeric','digits:11','exists:admins,mobile'],
            'password' => ['required','min:6'],
        ];
    }
}
