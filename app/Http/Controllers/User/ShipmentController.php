<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Requests\User\Shipment\StoreShipmentRequest;
use App\Http\Requests\User\Shipment\UpdateShipmentRequest;
use App\Models\Shipment;
use App\Models\Trip;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function index(): Factory|View
    {
        $shipments = Shipment::query()
            ->with(['user', 'trip'])
            ->latest()
            ->where('user_id',Auth::id())
            ->paginate(10);

        return view('panel.user-panel.shipments.index', compact('shipments'));
    }

    public function store(StoreShipmentRequest $request): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            Shipment::query()->create($validated);

            return redirect(route('user.shipments.index'))->with('success', trans('messages.created'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function create(): Factory|View
    {
        $trips = Trip::query()->latest('id')->where('status','planning')->get();

        return view('panel.user-panel.shipments.create', compact( 'trips'));
    }

    public function show(Shipment $shipment): Factory|View
    {
        $shipment->load(['user', 'trip']);
        if (!$shipment->getAttribute('user_id') == Auth::id()) {
            abort(403);
        }
        return view('panel.user-panel.shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment): Factory|View
    {
        if (!$shipment->getAttribute('user_id') == Auth::id()) {
            abort(403);
        }
        $trips = Trip::query()->latest('id')->where('status','planning')->get();

        return view('panel.user-panel.shipments.edit', compact('shipment',  'trips'));
    }

    public function update(UpdateShipmentRequest $request, Shipment $shipment): Redirector|RedirectResponse
    {
        if (!$shipment->getAttribute('user_id') == Auth::id()) {
            abort(403);
        }
        try {
            $validated = $request->validated();

            $shipment->update($validated);

            return redirect(route('user.shipments.index'))->with('success', trans('messages.updated'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Shipment $shipment): Redirector|RedirectResponse
    {
        if (!$shipment->getAttribute('user_id') == Auth::id()) {
            abort(403);
        }
        try {
            $shipment->delete();

            return redirect(route('user.shipments.index'))->with('success', trans('messages.deleted'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
