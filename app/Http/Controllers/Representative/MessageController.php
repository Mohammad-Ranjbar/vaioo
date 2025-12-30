<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Representative\StoreMessageRequest;
use App\Models\Message;
use App\Models\Shipment;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{

    public function store(StoreMessageRequest $request, string $shipment): RedirectResponse
    {
        $validatedData = $request->validated();
        try {
            Message::query()->create($validatedData);

            return back()->with('success', trans('messages.created'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function shipmentMessages(string $trackingCode): Factory|View
    {
        $shipment = Shipment::query()->where('tracking_code', $trackingCode)->with(['receivedMessages.replies', 'user', 'trip'])->firstOrFail();

        return view('panel.representative-panel.shipments.messages', compact('shipment'));
    }

}
