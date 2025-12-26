<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class SetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
                'string',
                'min:8'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'different:current_password' // Add this rule
            ],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->filled('current_password')) {
                if (!Hash::check($this->input('current_password'), auth()->user()->password)) {
                    $validator->errors()->add(
                        'current_password',
                        'رمز عبور فعلی اشتباه است.'
                    );
                }
            }
        });
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'رمز عبور فعلی',
            'password' => 'رمز عبور جدید',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'وارد کردن رمز عبور فعلی الزامی است.',
            'current_password.string' => 'رمز عبور فعلی باید متن باشد.',
            'current_password.min' => 'رمز عبور فعلی باید حداقل ۸ کاراکتر باشد.',

            'password.required' => 'وارد کردن رمز عبور جدید الزامی است.',
            'password.string' => 'رمز عبور جدید باید متن باشد.',
            'password.min' => 'رمز عبور جدید باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور جدید مطابقت ندارد.',
            'password.regex' => 'رمز عبور جدید باید شامل حروف بزرگ، حروف کوچک و اعداد باشد.',
            'password.different' => 'رمز عبور جدید باید با رمز عبور فعلی متفاوت باشد.',

            'current_password' => 'رمز عبور فعلی اشتباه است.',
        ];
    }
}
