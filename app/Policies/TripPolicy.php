<?php

namespace App\Policies;

use App\Models\Trip;

class TripPolicy
{
    public function view($representative, Trip $trip): bool
    {
        return $trip->getAttribute('representative_id') === $representative->id;
    }

    public function update($representative,Trip $trip): bool
    {
        return $trip->getAttribute('representative_id') === $representative->id;
    }

    public function delete($representative, Trip $trip): bool
    {
        return $trip->getAttribute('representative_id') === $representative->id;
    }
}
