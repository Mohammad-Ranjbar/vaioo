<?php

namespace App\Http\Requests\Representative;

use Illuminate\Foundation\Http\FormRequest;

class RepresentativeLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'mobile' => ['required','starts_with:09','numeric','digits:11','exists:representatives,mobile'],
            'password' => ['required','min:6'],
        ];
    }
}
