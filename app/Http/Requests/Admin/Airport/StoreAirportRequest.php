<?php

namespace App\Http\Requests\Admin\Airport;

use Illuminate\Foundation\Http\FormRequest;

class StoreAirportRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_fa' => 'required|string|max:255|unique:airports,name_fa',
            'name_en' => 'required|string|max:255|unique:airports,name_en',
            'code' => 'required|string|size:3|regex:/^[A-Z]{3}$/|unique:airports,code',
            'country_id' => 'required|integer|exists:countries,id',
            'is_active' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'name_fa' => 'نام فارسی',
            'name_en' => 'نام انگلیسی',
            'code' => 'کد فرودگاه',
            'country_id' => 'کشور',
            'is_active' => 'وضعیت',
        ];
    }

    public function messages(): array
    {
        return [
            'name_fa.required' => 'نام فارسی الزامی است.',
            'name_fa.string' => 'نام فارسی باید متن باشد.',
            'name_fa.max' => 'نام فارسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'name_fa.unique' => 'این نام فارسی قبلاً ثبت شده است.',

            'name_en.required' => 'نام انگلیسی الزامی است.',
            'name_en.string' => 'نام انگلیسی باید متن باشد.',
            'name_en.max' => 'نام انگلیسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'name_en.unique' => 'این نام انگلیسی قبلاً ثبت شده است.',

            'code.required' => 'کد فرودگاه الزامی است.',
            'code.string' => 'کد فرودگاه باید متن باشد.',
            'code.size' => 'کد فرودگاه باید دقیقاً ۳ حرف باشد.',
            'code.regex' => 'کد فرودگاه باید فقط شامل حروف بزرگ لاتین باشد.',
            'code.unique' => 'این کد فرودگاه قبلاً ثبت شده است.',

            'country_id.required' => 'انتخاب کشور الزامی است.',
            'country_id.integer' => 'کشور انتخاب شده معتبر نیست.',
            'country_id.exists' => 'کشور انتخاب شده وجود ندارد.',

            'is_active.required' => 'انتخاب وضعیت الزامی است.',
            'is_active.boolean' => 'وضعیت انتخاب شده معتبر نیست.',
        ];
    }


    protected function prepareForValidation(): void
    {
        if ($this->has('code')) {
            $this->merge([
                'code' => strtoupper(trim($this->input('code'))),
            ]);
        }

        if ($this->has('is_active')) {
            $this->merge([
                'is_active' => (bool) $this->input('is_active'),
            ]);
        }

        if ($this->has('country_id')) {
            $this->merge([
                'country_id' => (int) $this->input('country_id'),
            ]);
        }
    }
}
