<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Airport\StoreAirportRequest;
use App\Http\Requests\Admin\Airport\UpdateAirportRequest;
use App\Models\Airport;
use App\Models\Country;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AirportController extends Controller
{

    public function index(): Factory|View
    {
        $airports = Airport::query()->latest()->paginate(25);

        return view('panel.admin-panel.airports.index', compact('airports'));
    }

    public function store(StoreAirportRequest $request): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            Airport::query()->create($validated);

            return redirect(route('admin.airports.index'))->with('success', trans('created'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function create(): Factory|View
    {
        $countries = Country::query()->latest()->get();
        return view('panel.admin-panel.airports.create', compact('countries'));

    }

    public function show(Airport $airport)
    {
        //
    }

    public function edit(Airport $airport): Factory|View
    {
        $countries = Country::query()->latest()->get();
        return view('panel.admin-panel.airports.edit', compact('airport', 'countries'));
    }

    public function update(UpdateAirportRequest $request, Airport $airport): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            $airport->update($validated);

            return redirect(route('admin.airports.index'))->with('success', trans('updated'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(Airport $airport): Redirector|RedirectResponse
    {
        try {

            $airport->delete();

            return redirect(route('admin.airports.index'))->with('success', trans('deleted'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
