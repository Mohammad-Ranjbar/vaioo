<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Representative\Trip\StoreTripRequest;
use App\Http\Requests\Representative\Trip\UpdateTripRequest;
use App\Models\Airport;
use App\Models\Trip;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    /**
     * @throws AuthorizationException
     */
    public function show(Trip $trip): Factory|View
    {
        $representative = Auth::guard('representative')->user();
        Gate::forUser($representative)->authorize('view', $trip);

        return view('panel.representative-panel.trips.show', compact('trip'));
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Trip $trip): Factory|View
    {
        $representative = Auth::guard('representative')->user();
        Gate::forUser($representative)->authorize('update', $trip);

        $airports = Airport::query()->latest('id')->get();
        return view('panel.representative-panel.trips.edit', compact('airports', 'trip'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateTripRequest $request, Trip $trip): Redirector|RedirectResponse
    {
        $representative = Auth::guard('representative')->user();
        Gate::forUser($representative)->authorize('update', $trip);
        try {
            $validated = $request->validated();

            $trip->update($validated);

            return redirect(route('representative.trips.index'))->with('success', trans('messages.updated'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Trip $trip): Redirector|RedirectResponse
    {
        $representative = Auth::guard('representative')->user();
        Gate::forUser($representative)->authorize('delete', $trip);
        try {

            $trip->delete();

            return redirect(route('representative.trips.index'))->with('success', trans('messages.deleted'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
}
