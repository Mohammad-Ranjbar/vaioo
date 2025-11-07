<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneOtpRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|regex:/^\+?[1-9]\d{1,14}$/', // E.164
        ];
    }
}
