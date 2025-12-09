<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Trip\StoreTripRequest;
use App\Http\Requests\Admin\Trip\UpdateTripRequest;
use App\Models\Airport;
use App\Models\Trip;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{

    public function index(Request $request): Factory|View
    {
        $trips = Trip::query()->where('representative_id', Auth::guard('representative')->id())
            ->with(['representative', 'sourceAirport', 'destinationAirport'])
            ->filter($request)
            ->latest('id')
            ->paginate(25);

        return view('panel.representative-panel.trips.index', compact('trips'));
    }

    public function store(StoreTripRequest $request): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            Trip::query()->create($validated);

            return redirect(route('representative.trips.index'))->with('success', trans('created'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    public function create(): Factory|View
    {
        $airports = Airport::query()->latest('id')->get();

        return view('panel.representative-panel.trips.create', compact('airports'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Trip $trip): Factory|View
    {
        $airports = Airport::query()->latest('id')->get();
        return view('panel.representative-panel.trips.edit', compact('airports', 'trip'));
    }

    public function update(UpdateTripRequest $request, Trip $trip): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            $trip->update($validated);

            return redirect(route('representative.trips.index'))->with('success', trans('messages.updated'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    public function destroy(Trip $trip): Redirector|RedirectResponse
    {
        try {

            $trip->delete();

            return redirect(route('representative.trips.index'))->with('success', trans('messages.deleted'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
}
