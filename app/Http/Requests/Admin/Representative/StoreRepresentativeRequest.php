<?php

namespace App\Http\Requests\Admin\Representative;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRepresentativeRequest extends FormRequest
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
            'national_code' => ['required', 'string', 'regex:/^[0-9]{10}$/', 'unique:representatives,national_code'],
            'passport_number' => ['nullable', 'string', 'max:255', 'unique:representatives,passport_number'],
            'email' => ['nullable', 'email', 'max:255', 'unique:representatives,email'],
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/', 'unique:representatives,mobile'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'is_active' => ['required', 'boolean'],
            'verification_status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
            'verification_rejection_reason' => ['nullable', 'string', 'max:1000'],
            'mobile_verified' => ['sometimes', 'boolean'],
            'email_verified' => ['sometimes', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'نام',
            'family' => 'نام خانوادگی',
            'national_code' => 'کد ملی',
            'passport_number' => 'شماره پاسپورت',
            'email' => 'ایمیل',
            'mobile' => 'موبایل',
            'password' => 'رمز عبور',
            'birth_date' => 'تاریخ تولد',
            'profile_image' => 'تصویر پروفایل',
            'is_active' => 'وضعیت فعال',
            'verification_status' => 'وضعیت تایید',
            'verification_rejection_reason' => 'دلیل رد تایید',
        ];
    }

    public function messages(): array
    {
        return [
            'national_code.required' => 'کد ملی الزامی است.',
            'national_code.regex' => 'فرمت کد ملی معتبر نیست. (باید 10 رقم باشد)',
            'national_code.unique' => 'این کد ملی قبلا ثبت شده است.',
            'passport_number.unique' => 'این شماره پاسپورت قبلا ثبت شده است.',
            'mobile.required' => 'شماره موبایل الزامی است.',
            'mobile.regex' => 'فرمت شماره موبایل معتبر نیست. (مثال: 09123456789)',
            'mobile.unique' => 'این شماره موبایل قبلا ثبت شده است.',
            'email.email' => 'فرمت ایمیل معتبر نیست.',
            'email.unique' => 'این ایمیل قبلا ثبت شده است.',
            'password.required' => 'رمز عبور الزامی است.',
            'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور مطابقت ندارد.',
            'birth_date.date' => 'فرمت تاریخ تولد معتبر نیست.',
            'birth_date.before' => 'تاریخ تولد باید قبل از امروز باشد.',
            'profile_image.image' => 'فایل باید یک تصویر معتبر باشد.',
            'profile_image.mimes' => 'فرمت تصویر باید یکی از موارد: jpeg, png, jpg, gif باشد.',
            'profile_image.max' => 'حجم تصویر نباید بیشتر از 2 مگابایت باشد.',
            'is_active.required' => 'انتخاب وضعیت فعال بودن الزامی است.',
            'verification_status.required' => 'انتخاب وضعیت تایید الزامی است.',
            'verification_status.in' => 'وضعیت تایید انتخاب شده معتبر نیست.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('national_code')) {
            $this->merge([
                'national_code' => preg_replace('/\s+/', '', $this->input('national_code')),
            ]);
        }

        if ($this->has('mobile')) {
            $this->merge([
                'mobile' => preg_replace('/\s+/', '', $this->input('mobile')),
            ]);
        }

        if ($this->has('passport_number') && !empty($this->passport_number)) {
            $this->merge([
                'passport_number' => preg_replace('/\s+/', '', $this->passport_number),
            ]);
        }

        // Handle mobile verification
        if ($this->has('mobile_verified') && $this->input('mobile_verified') == '1') {
            $this->merge([
                'mobile_verified_at' => now(),
            ]);
        } else {
            $this->merge([
                'mobile_verified_at' => null,
            ]);
        }

        // Handle email verification
        if ($this->has('email_verified') && $this->input('email_verified') == '1') {
            $this->merge([
                'email_verified_at' => now(),
            ]);
        } else {
            $this->merge([
                'email_verified_at' => null,
            ]);
        }

        // Handle verification status and verified_at
        if ($this->has('verification_status') && $this->input('verification_status') == 'approved') {
            $this->merge([
                'verified_at' => now(),
            ]);
        } else {
            $this->merge([
                'verified_at' => null,
            ]);
        }

        // Clear rejection reason if status is not rejected
        if ($this->has('verification_status') && $this->input('verification_status') !== 'rejected') {
            $this->merge([
                'verification_rejection_reason' => null,
            ]);
        }

        // Convert boolean fields
        $this->merge([
            'is_active' => (bool)$this->input('is_active'),
            'mobile_verified' => (bool)$this->input('mobile_verified'),
            'email_verified' => (bool)$this->input('email_verified'),
        ]);
    }

    /**
     * Configure the validator instance.
     */
    protected function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->input('verification_status') == 'rejected' && empty($this->verification_rejection_reason)) {
                $validator->errors()->add(
                    'verification_rejection_reason',
                    'در صورت رد تایید، وارد کردن دلیل الزامی است.'
                );
            }
        });
    }
}
