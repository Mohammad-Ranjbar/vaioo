<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Trip\StoreTripRequest;
use App\Http\Requests\Admin\Trip\UpdateTripRequest;
use App\Models\Airport;
use App\Models\Representative;
use App\Models\Trip;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TripController extends Controller
{
    public function index(Request $request): Factory|View
    {
        $trips = Trip::query()->with(['representative', 'sourceAirport', 'destinationAirport'])
            ->filter($request)
            ->latest('id')
            ->paginate(20);

        return view('panel.admin-panel.trips.index', compact('trips'));
    }

    public function availableTrips(Request $request)
    {
        $trips = Trip::query()->with(['representative', 'sourceAirport', 'destinationAirport'])
            ->filter($request)
            ->where('status', 'planning')
            ->where('departure_date', '>=', now())
            ->orderBy('departure_date', 'asc')
            ->paginate(20);

        return response()->json($trips);
    }

    public function representativeTrips($representativeId, Request $request)
    {
        $trips = Trip::query()->with(['sourceAirport', 'destinationAirport'])
            ->where('representative_id', $representativeId)
            ->filter($request)
            ->orderBy('departure_date', 'desc')
            ->paginate(20);

        return response()->json($trips);
    }

    public function store(StoreTripRequest $request): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            Trip::query()->create($validated);

            return redirect(route('admin.trips.index'))->with('success', trans('created'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    public function create(): Factory|View
    {
        $representatives = Representative::query()->select(['name', 'family', 'mobile', 'id'])->latest('id')->get();
        $airports = Airport::query()->latest('id')->get();
        return view('panel.admin-panel.trips.create', compact('representatives', 'airports'));
    }

    public function show(Trip $trip)
    {
        //
    }

    public function edit(Trip $trip): Factory|View
    {
        $representatives = Representative::query()->select(['name', 'family', 'mobile', 'id'])->latest('id')->get();
        $airports = Airport::query()->latest('id')->get();
        return view('panel.admin-panel.trips.edit', compact('representatives', 'airports', 'trip'));
    }


    public function update(UpdateTripRequest $request, Trip $trip): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            $trip->update($validated);

            return redirect(route('admin.trips.index'))->with('success', trans('messages.updated'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    public function destroy(Trip $trip): Redirector|RedirectResponse
    {
        try {

            $trip->delete();

            return redirect(route('admin.trips.index'))->with('success', trans('messages.deleted'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
}
