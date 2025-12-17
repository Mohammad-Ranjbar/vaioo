<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Representative\UpdateShipmentRequest;
use App\Models\Shipment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class ShipmentController extends Controller
{
    public function index(): Factory|View
    {
        $shipments = Shipment::query()->whereHas('trip', function ($q) {
            $q->where('representative_id', Auth::guard('representative')->id());
        })->with(['trip', 'user'])->paginate(20);

        return view('panel.representative-panel.shipments.index', compact('shipments'));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Shipment $shipment): Factory|View
    {
        $representative = Auth::guard('representative')->user();
        Gate::forUser($representative)->authorize('view', $shipment);

        return view('panel.representative-panel.shipments.show', compact('shipment'));
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Shipment $shipment): Factory|View
    {
        $representative = Auth::guard('representative')->user();
        Gate::forUser($representative)->authorize('view', $shipment);

        return view('panel.representative-panel.shipments.edit', compact('shipment'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateShipmentRequest $request,Shipment $shipment)
    {
        $representative = Auth::guard('representative')->user();
        Gate::forUser($representative)->authorize('update', $shipment);
        try {
            $shipment->update($request->validated());

            return back()->with('success',trans('messages.updated'));
        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }

    }
}
