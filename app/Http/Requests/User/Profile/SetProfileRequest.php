<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class SetProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\p{L}\s\-\.]+$/u'
            ],
            'family' => [
                'required',
                'string',
                'max:150',
                'regex:/^[\p{L}\s\-\.]+$/u'
            ],

            'current_password' => [
                'required_with:password',
                'string',
                'min:8'
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],


        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->filled('current_password') && $this->filled('password')) {
                if (!Hash::check($this->input('current_password'), auth()->user()->password)) {
                    $validator->errors()->add(
                        'current_password',
                        'رمز عبور فعلی اشتباه است.'
                    );
                }

                if ($this->input('current_password') === $this->input('password')) {
                    $validator->errors()->add(
                        'password',
                        'رمز عبور جدید باید با رمز عبور فعلی متفاوت باشد.'
                    );
                }
            }
        });
    }

    public function attributes(): array
    {
        return [
            'name' => 'نام',
            'family' => 'نام خانوادگی',
            'current_password' => 'رمز عبور فعلی',
            'password' => 'رمز عبور جدید',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'name.string' => 'نام باید متن باشد.',
            'name.max' => 'نام نمی‌تواند بیشتر از ۱۰۰ کاراکتر باشد.',
            'name.regex' => 'نام فقط می‌تواند حاوی حروف، فاصله، خط تیره و نقطه باشد.',

            'family.required' => 'وارد کردن نام خانوادگی الزامی است.',
            'family.string' => 'نام خانوادگی باید متن باشد.',
            'family.max' => 'نام خانوادگی نمی‌تواند بیشتر از ۱۵۰ کاراکتر باشد.',
            'family.regex' => 'نام خانوادگی فقط می‌تواند حاوی حروف، فاصله، خط تیره و نقطه باشد.',

            'current_password.required_with' => 'برای تغییر رمز عبور، وارد کردن رمز عبور فعلی الزامی است.',
            'current_password.string' => 'رمز عبور فعلی باید متن باشد.',
            'current_password.min' => 'رمز عبور فعلی باید حداقل ۸ کاراکتر باشد.',

            'password.string' => 'رمز عبور جدید باید متن باشد.',
            'password.min' => 'رمز عبور جدید باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور جدید مطابقت ندارد.',
            'password.regex' => 'رمز عبور جدید باید شامل حروف بزرگ، حروف کوچک و اعداد باشد.',

            'current_password' => 'رمز عبور فعلی اشتباه است.',
            'password' => 'رمز عبور جدید باید با رمز عبور فعلی متفاوت باشد.'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim($this->input('name')),
            'family' => trim($this->input('family')),
        ]);
    }
}
