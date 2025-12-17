<?php

namespace App\Policies;

use App\Models\Shipment;

class ShipmentPolicy
{
    public function view($representative, Shipment $shipment): bool
    {
        return $shipment->trip->getAttribute('representative_id') === $representative->id;
    }

    public function update($representative, Shipment $shipment): bool
    {
        return $shipment->trip->getAttribute('representative_id') === $representative->id;
    }

    public function delete($representative, Shipment $shipment): bool
    {
        return $shipment->trip->getAttribute('representative_id') === $representative->id;
    }
}
