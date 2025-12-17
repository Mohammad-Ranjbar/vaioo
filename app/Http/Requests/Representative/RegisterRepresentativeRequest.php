<?php

namespace App\Http\Requests\Representative;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRepresentativeRequest extends FormRequest
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

            'national_code' => [
                'required',
                'string',
                'size:10',
                'regex:/^[0-9]{10}$/',
                Rule::unique('representatives', 'national_code'),
                function ($attribute, $value, $fail) {
                    if (!$this->isValidNationalCode($value)) {
                        $fail('کد ملی وارد شده معتبر نیست.');
                    }
                }
            ],
            'passport_number' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('representatives', 'passport_number'),
            ],

            'mobile' => [
                'required',
                'string',
                'regex:/^09[0-9]{9}$/',
                Rule::unique('representatives', 'mobile'),
            ],
            'email' => [
                'nullable',
                'email:rfc,dns',
                'max:100',
                Rule::unique('representatives', 'email'),
            ],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],

            'terms' => ['required', 'accepted'],
            'privacy' => ['required', 'accepted'],

            'verification_status' => 'nullable',
            'is_active' => 'nullable',
            'verified_at' => 'nullable',
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

            'national_code.required' => 'وارد کردن کد ملی الزامی است.',
            'national_code.size' => 'کد ملی باید ۱۰ رقم باشد.',
            'national_code.regex' => 'فرمت کد ملی صحیح نیست.',
            'national_code.unique' => 'این کد ملی قبلاً ثبت شده است.',

            'passport_number.unique' => 'این شماره پاسپورت قبلاً ثبت شده است.',
            'passport_number.max' => 'شماره پاسپورت نمی‌تواند بیشتر از ۵۰ کاراکتر باشد.',


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
            'national_code' => 'کد ملی',
            'passport_number' => 'شماره پاسپورت',
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
            'verification_status' => 'pending',
            'is_active' => false,
            'verified_at' => null,
            'national_code' => preg_replace('/[^0-9]/', '', $this->input('national_code')),
            'mobile' => preg_replace('/[^0-9]/', '', $this->input('mobile')),
            'name' => trim($this->input('name')),
            'family' => trim($this->input('family')),
            'email' => $this->input('email') ? trim(strtolower($this->input('email'))) : null,
            'passport_number' => $this->input('passport_number') ? trim($this->input('passport_number')) : null,
        ]);
    }

    private function isValidNationalCode(string $code): bool
    {
        if (!preg_match('/^\d{10}$/', $code)) {
            return false;
        }

        if (preg_match('/^(\d)\1{9}$/', $code)) {
            return false;
        }

        $check = (int) $code[9];
        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $code[$i] * (10 - $i);
        }

        $remainder = $sum % 11;
        $calculatedCheck = $remainder < 2 ? $remainder : 11 - $remainder;

        return $calculatedCheck === $check;
    }
}