<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => ['required', 'string', 'max:100', 'min:2'],
            'family' => ['required', 'string', 'max:100', 'min:2'],


            'mobile' => [
                'required',
                'string',
                'regex:/^09[0-9]{9}$/',
                Rule::unique('users', 'mobile'),
            ],
            'email' => [
                'nullable',
                'email:rfc,dns',
                'max:100',
                Rule::unique('users', 'email'),
            ],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],

            'terms' => ['required', 'accepted'],
            'privacy' => ['required', 'accepted'],

            'is_active' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'name.min' => 'نام باید حداقل ۲ کاراکتر باشد.',
            'name.max' => 'نام نمی‌تواند بیشتر از ۱۰۰ کاراکتر باشد.',

            'family.required' => 'وارد کردن نام خانوادگی الزامی است.',
            'family.min' => 'نام خانوادگی باید حداقل ۲ کاراکتر باشد.',
            'family.max' => 'نام خانوادگی نمی‌تواند بیشتر از ۱۰۰ کاراکتر باشد.',

            'mobile.required' => 'وارد کردن شماره موبایل الزامی است.',
            'mobile.regex' => 'فرمت شماره موبایل صحیح نیست. (مثال: ۰۹۱۲۱۲۳۴۵۶۷)',
            'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است.',

            'email.email' => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email.max' => 'ایمیل نمی‌تواند بیشتر از ۱۰۰ کاراکتر باشد.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',

            'password.required' => 'وارد کردن رمز عبور الزامی است.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'رمز عبور و تکرار آن مطابقت ندارند.',

            'password_confirmation.required' => 'تکرار رمز عبور الزامی است.',

            'terms.required' => 'پذیرش شرایط و قوانین الزامی است.',
            'terms.accepted' => 'لطفاً شرایط و قوانین را بپذیرید.',

            'privacy.required' => 'پذیرش حریم خصوصی الزامی است.',
            'privacy.accepted' => 'لطفاً حریم خصوصی را بپذیرید.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'نام',
            'family' => 'نام خانوادگی',
            'mobile' => 'شماره موبایل',
            'email' => 'ایمیل',
            'password' => 'رمز عبور',
            'password_confirmation' => 'تکرار رمز عبور',
            'terms' => 'شرایط و قوانین',
            'privacy' => 'حریم خصوصی',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => true,
            'mobile' => preg_replace('/[^0-9]/', '', $this->input('mobile')),
            'name' => trim($this->input('name')),
            'family' => trim($this->input('family')),
            'email' => $this->input('email') ? trim(strtolower($this->input('email'))) : null,
        ]);
    }
}
