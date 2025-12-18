<?php

namespace App\Http\Requests\User\Shipment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreShipmentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trip_id' => 'required|exists:trips,id',
            'user_id' => 'nullable',
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:255',
            'reciver_name' => 'required|string|max:255',
            'reciver_phone' => 'required|string|max:255',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0.01',
            'declared_value' => 'required|numeric|min:0',
            'status' => 'nullable',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => Auth::id(),
            'status' => 'pending'
        ]);
    }

    public function attributes(): array
    {
        return [
            'trip_id' => 'سفر',
            'user_id' => 'کاربر',
            'sender_name' => 'نام فرستنده',
            'sender_phone' => 'تلفن فرستنده',
            'reciver_name' => 'نام گیرنده',
            'reciver_phone' => 'تلفن گیرنده',
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
            'reciver_name.required' => 'نام گیرنده الزامی است.',
            'reciver_phone.required' => 'تلفن گیرنده الزامی است.',
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