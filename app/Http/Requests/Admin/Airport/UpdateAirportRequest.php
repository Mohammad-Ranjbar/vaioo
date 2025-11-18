<?php

namespace App\Http\Requests\Admin\Airport;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAirportRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $airportId = $this->route('airport');

        return [
            'name_fa' => [
                'required',
                'string',
                'max:255',
                Rule::unique('airports')->ignore($airportId),
            ],
            'name_en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('airports')->ignore($airportId),
            ],
            'code' => [
                'required',
                'string',
                'size:3',
                'regex:/^[A-Z]{3}$/',
                Rule::unique('airports')->ignore($airportId),
            ],
            'country_id' => [
                'required',
                'integer',
                'exists:countries,id',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
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

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name_fa.required' => 'نام فارسی الزامی است.',
            'name_fa.unique' => 'این نام فارسی قبلاً ثبت شده است.',
            'name_en.required' => 'نام انگلیسی الزامی است.',
            'name_en.unique' => 'این نام انگلیسی قبلاً ثبت شده است.',
            'code.required' => 'کد فرودگاه الزامی است.',
            'code.size' => 'کد فرودگاه باید 3 حرف باشد.',
            'code.regex' => 'کد فرودگاه باید فقط شامل حروف بزرگ لاتین باشد.',
            'code.unique' => 'این کد فرودگاه قبلاً ثبت شده است.',
            'country_id.required' => 'انتخاب کشور الزامی است.',
            'country_id.exists' => 'کشور انتخاب شده معتبر نیست.',
            'is_active.required' => 'انتخاب وضعیت الزامی است.',
            'is_active.boolean' => 'وضعیت انتخاب شده معتبر نیست.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('code')) {
            $this->merge([
                'code' => strtoupper($this->code),
            ]);
        }
    }
}
