<?php

namespace App\Http\Requests\Admin\Representative;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepresentativeDocumentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'national_card_front' => ['nullable', 'image', 'mimes:jpeg', 'max:2048'],
            'national_card_back' => ['nullable', 'image', 'mimes:jpeg', 'max:2048'],
            'selfie_with_card' => ['nullable', 'image', 'mimes:jpeg', 'max:2048'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'national_card_front' => 'تصویر روی کارت ملی',
            'national_card_back' => 'تصویر پشت کارت ملی',
            'selfie_with_card' => 'سلفی با کارت ملی',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'national_card_front.image' => 'فایل روی کارت ملی باید یک تصویر معتبر باشد.',
            'national_card_front.mimes' => 'فرمت تصویر روی کارت ملی باید JPEG باشد.',
            'national_card_front.max' => 'حجم تصویر روی کارت ملی نباید بیشتر از 2 مگابایت باشد.',

            'national_card_back.image' => 'فایل پشت کارت ملی باید یک تصویر معتبر باشد.',
            'national_card_back.mimes' => 'فرمت تصویر پشت کارت ملی باید JPEG باشد.',
            'national_card_back.max' => 'حجم تصویر پشت کارت ملی نباید بیشتر از 2 مگابایت باشد.',

            'selfie_with_card.image' => 'فایل سلفی با کارت ملی باید یک تصویر معتبر باشد.',
            'selfie_with_card.mimes' => 'فرمت تصویر سلفی با کارت ملی باید JPEG باشد.',
            'selfie_with_card.max' => 'حجم تصویر سلفی با کارت ملی نباید بیشتر از 2 مگابایت باشد.',
        ];
    }
}
