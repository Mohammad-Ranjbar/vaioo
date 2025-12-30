<?php

namespace App\Http\Requests\Representative;

use App\Models\Message;
use App\Models\Representative;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMessageRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sender_type' => 'nullable',
            'sender_id' => 'nullable',
            'receiver_type' => 'nullable',
            'receiver_id' => 'nullable',
            'parent_id' => 'nullable',
            'message' => 'required|string|max:1000',
        ];
    }

    protected function prepareForValidation(): void
    {
        $shipmentId = $this->route('shipment');
        $parent = Message::query()
            ->where('receiver_type', Shipment::class)
            ->where('receiver_id', $shipmentId)
            ->whereNull('parent_id')
            ->first();
        $parentId = null;
        if ($parent) {
            $parentId = $parent->getAttribute('id');
        }

        $this->merge([
            'sender_type' => Representative::class,
            'sender_id' => Auth::guard('representative')->id(),
            'receiver_type' => Shipment::class,
            'receiver_id' => $shipmentId,
            'parent_id' => $parentId,
        ]);
    }
}
