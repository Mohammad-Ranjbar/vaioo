<?php

namespace App\Observers;

use App\Models\Shipment;
use App\Services\GenerateTrackingCode;

class ShipmentObserver
{
    /**
     * @throws \Exception
     */
    public function creating(Shipment $shipment): void
    {
        $shipment->tracking_code = GenerateTrackingCode::generate('shipments');
    }
    public function created(Shipment $shipment): void
    {

    }

    /**
     * Handle the Shipment "updated" event.
     */
    public function updated(Shipment $shipment): void
    {
        //
    }

    /**
     * Handle the Shipment "deleted" event.
     */
    public function deleted(Shipment $shipment): void
    {
        //
    }

    /**
     * Handle the Shipment "restored" event.
     */
    public function restored(Shipment $shipment): void
    {
        //
    }

    /**
     * Handle the Shipment "force deleted" event.
     */
    public function forceDeleted(Shipment $shipment): void
    {
        //
    }
}
