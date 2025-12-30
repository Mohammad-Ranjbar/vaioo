<?php

namespace App\Http\Requests\User\Shipment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trip_id' => 'required|exists:trips,id',
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:255',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0.01',
            'declared_value' => 'required|numeric|min:0',
        ];
    }

    public function attributes(): array
    {
        return [
            'trip_id' => 'سفر',
            'sender_name' => 'نام فرستنده',
            'sender_phone' => 'تلفن فرستنده',
            'receiver_name' => 'نام گیرنده',
            'receiver_phone' => 'تلفن گیرنده',
            'weight' => 'وزن',
            'declared_value' => 'ارزش اعلامی',
            'status' => 'وضعیت',
        ];
    }

    public function messages(): array
    {
        return [
            'trip_id.required' => 'انتخاب سفر الزامی است.',
            'trip_id.exists' => 'سفر انتخاب شده معتبر نیست.',
            'user_id.required' => 'انتخاب کاربر الزامی است.',
            'user_id.exists' => 'کاربر انتخاب شده معتبر نیست.',
            'sender_name.required' => 'نام فرستنده الزامی است.',
            'sender_phone.required' => 'تلفن فرستنده الزامی است.',
            'receiver_name.required' => 'نام گیرنده الزامی است.',
            'receiver_phone.required' => 'تلفن گیرنده الزامی است.',
            'weight.required' => 'وزن الزامی است.',
            'weight.numeric' => 'وزن باید عددی باشد.',
            'weight.min' => 'وزن باید بیشتر از ۰ باشد.',
            'declared_value.required' => 'ارزش اعلامی الزامی است.',
            'declared_value.numeric' => 'ارزش اعلامی باید عددی باشد.',
            'declared_value.min' => 'ارزش اعلامی باید بیشتر از ۰ باشد.',
            'status.required' => 'انتخاب وضعیت الزامی است.',
            'status.in' => 'وضعیت انتخاب شده معتبر نیست.',
        ];
    }
}
