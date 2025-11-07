<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|regex:/^\+?[1-9]\d{1,14}$/',
            'otp' => 'required|digits:6',
        ];
    }
}
