<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $trips = Trip::query()->with(['representative', 'sourceAirport', 'destinationAirport'])
            ->filter($request)
            ->orderBy('departure_date', 'desc')
            ->paginate(20);

        return response()->json($trips);
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
