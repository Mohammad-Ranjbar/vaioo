<?php

namespace App\Http\Requests\Representative\Trip;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'representative_id' => [
                'nullable',
            ],
            'source_airport_id' => [
                'required',
                'exists:airports,id',
                'different:destination_airport_id'
            ],
            'destination_airport_id' => [
                'required',
                'exists:airports,id',
                'different:source_airport_id'
            ],
            'departure_date' => [
                'required',
                'date',
                'after_or_equal:today'
            ],
            'arrival_date' => [
                'required',
                'date',
                'after_or_equal:departure_date'
            ],
            'capacity_weight' => [
                'required',
                'numeric',
                'min:0.01',
                'decimal:0,2'
            ],
            'capacity_value' => [
                'required',
                'numeric',
                'min:0.01',
                'decimal:0,2'
            ],
            'status' => [
                'required',
                Rule::in(['planning', 'in_progress', 'completed'])
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'representative_id' => 'نماینده',
            'source_airport_id' => 'فرودگاه مبدا',
            'destination_airport_id' => 'فرودگاه مقصد',
            'departure_date' => 'تاریخ رفت',
            'arrival_date' => 'تاریخ برگشت',
            'capacity_weight' => 'ظرفیت وزن',
            'capacity_value' => 'ظرفیت ارزش',
            'status' => 'وضعیت',
        ];
    }

    public function messages(): array
    {
        return [
            'representative_id.required' => 'انتخاب نماینده الزامی است.',
            'representative_id.exists' => 'نماینده انتخاب شده معتبر نیست.',

            'source_airport_id.required' => 'انتخاب فرودگاه مبدا الزامی است.',
            'source_airport_id.exists' => 'فرودگاه مبدا انتخاب شده معتبر نیست.',
            'source_airport_id.different' => 'فرودگاه مبدا و مقصد نمی‌توانند یکسان باشند.',

            'destination_airport_id.required' => 'انتخاب فرودگاه مقصد الزامی است.',
            'destination_airport_id.exists' => 'فرودگاه مقصد انتخاب شده معتبر نیست.',
            'destination_airport_id.different' => 'فرودگاه مبدا و مقصد نمی‌توانند یکسان باشند.',

            'departure_date.required' => 'تاریخ رفت الزامی است.',
            'departure_date.date' => 'تاریخ رفت باید یک تاریخ معتبر باشد.',
            'departure_date.after_or_equal' => 'تاریخ رفت نمی‌تواند از امروز کوچکتر باشد.',

            'arrival_date.required' => 'تاریخ برگشت الزامی است.',
            'arrival_date.date' => 'تاریخ برگشت باید یک تاریخ معتبر باشد.',
            'arrival_date.after_or_equal' => 'تاریخ برگشت نمی‌تواند از تاریخ رفت کوچکتر باشد.',

            'capacity_weight.required' => 'ظرفیت وزن الزامی است.',
            'capacity_weight.numeric' => 'ظرفیت وزن باید یک عدد باشد.',
            'capacity_weight.min' => 'ظرفیت وزن باید بزرگتر از صفر باشد.',
            'capacity_weight.decimal' => 'ظرفیت وزن باید حداکثر ۲ رقم اعشار داشته باشد.',

            'capacity_value.required' => 'ظرفیت ارزش الزامی است.',
            'capacity_value.numeric' => 'ظرفیت ارزش باید یک عدد باشد.',
            'capacity_value.min' => 'ظرفیت ارزش باید بزرگتر از صفر باشد.',
            'capacity_value.decimal' => 'ظرفیت ارزش باید حداکثر ۲ رقم اعشار داشته باشد.',

            'status.required' => 'وضعیت الزامی است.',
            'status.in' => 'وضعیت انتخاب شده معتبر نیست.',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $exists = DB::table('trips')
                ->where('representative_id', $this->input('representative_id'))
                ->where('source_airport_id', $this->input('source_airport_id'))
                ->where('destination_airport_id', $this->input('destination_airport_id'))
                ->exists();

            if ($exists) {
                $validator->errors()->add(
                    'unique_trip',
                    'ترکیب انتخاب شده برای نماینده، فرودگاه مبدا و مقصد تکراری است. لطفاً مقادیر متفاوتی انتخاب کنید.'
                );
            }
        });
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'representative_id' => Auth::guard('representative')->id(),
            'capacity_weight' => (float)str_replace(',', '', $this->input('capacity_weight')),
            'capacity_value' => (float)str_replace(',', '', $this->input('capacity_value')),
        ]);
    }
}
