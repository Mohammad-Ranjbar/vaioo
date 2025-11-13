<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePolicyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'policy' => 'required',
            'is_active' => 'required|boolean',
//            'admin_id' => 'required|integer|exists:admins,id',
        ];
    }

    protected function prepareForValidation(): void
    {
//        $this->merge([
//            'admin_id' => Auth::guard('admin')->id(),
//        ]);
    }
}
