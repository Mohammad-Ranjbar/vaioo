<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'family' => ['nullable', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/', 'unique:users,mobile'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_active' => ['required', 'boolean'],
            'mobile_verified' => ['sometimes', 'boolean'],
            'mobile_verified_at' => ['nullable'],
        ];
    }


    public function attributes(): array
    {
        return [
            'name' => 'نام',
            'family' => 'نام خانوادگی',
            'mobile' => 'موبایل',
            'email' => 'ایمیل',
            'password' => 'رمز عبور',
            'is_active' => 'وضعیت',
        ];
    }

    public function messages(): array
    {
        return [
            'mobile.required' => 'شماره موبایل الزامی است.',
            'mobile.regex' => 'فرمت شماره موبایل معتبر نیست. (مثال: 09123456789)',
            'mobile.unique' => 'این شماره موبایل قبلا ثبت شده است.',
            'email.email' => 'فرمت ایمیل معتبر نیست.',
            'email.unique' => 'این ایمیل قبلا ثبت شده است.',
            'password.required' => 'رمز عبور الزامی است.',
            'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور مطابقت ندارد.',
            'is_active.required' => 'انتخاب وضعیت کاربر الزامی است.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->input('mobile_verified') == '1') {
            $this->merge([
                'mobile_verified_at' => now()->toDateTimeString(),
            ]);
        }
        if ($this->has('mobile')) {
            $this->merge([
                'mobile' => preg_replace('/\s+/', '', $this->input('mobile')),
            ]);
        }

        $this->merge([
            'is_active' => (bool) $this->input('is_active'),
        ]);
    }
}
