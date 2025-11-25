<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Shipment\StoreShipmentRequest;
use App\Http\Requests\Admin\Shipment\UpdateShipmentRequest;
use App\Models\Shipment;
use App\Models\Trip;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ShipmentController extends Controller
{
    public function index(): Factory|View
    {
        $shipments = Shipment::query()
            ->with(['user', 'trip'])
            ->latest()
            ->paginate(10);

        return view('panel.admin-panel.shipments.index', compact('shipments'));
    }

    public function store(StoreShipmentRequest $request): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            Shipment::query()->create($validated);

            return redirect(route('admin.shipments.index'))->with('success', trans('messages.created'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function create(): Factory|View
    {
        $users = User::query()->latest('id')->get();
        $trips = Trip::query()->latest('id')->where('status','planning')->get();

        return view('panel.admin-panel.shipments.create', compact('users', 'trips'));
    }

    public function show(Shipment $shipment): Factory|View
    {
        $shipment->load(['user', 'trip']);
        return view('panel.admin-panel.shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment): Factory|View
    {
        $users = User::query()->latest()->get();
        $trips = Trip::query()->latest('id')->where('status','planning')->get();

        return view('panel.admin-panel.shipments.edit', compact('shipment', 'users', 'trips'));
    }

    public function update(UpdateShipmentRequest $request, Shipment $shipment): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            $shipment->update($validated);

            return redirect(route('admin.shipments.index'))->with('success', trans('messages.updated'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Shipment $shipment): Redirector|RedirectResponse
    {
        try {
            $shipment->delete();

            return redirect(route('admin.shipments.index'))->with('success', trans('messages.deleted'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}