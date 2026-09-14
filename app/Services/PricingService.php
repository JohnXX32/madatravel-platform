<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Vehicle;
use Carbon\CarbonInterface;

class PricingService
{
    public function quoteVehicle(
        Vehicle $vehicle,
        CarbonInterface $startOn,
        CarbonInterface $endOn,
        bool $withDriver,
        ?Location $pickup = null,
        ?Location $dropoff = null,
    ): array {
        $days = max(1, (int) $startOn->startOfDay()->diffInDays($endOn->startOfDay()));

        $vehicleMga = $vehicle->daily_rate_mga * $days;
        $chauffeurMga = $withDriver ? $vehicle->chauffeur_daily_rate_mga * $days : 0;
        $pickupFee = $pickup?->extra_fee_mga ?? 0;
        $dropoffFee = $dropoff?->extra_fee_mga ?? 0;

        return [
            'days' => $days,
            'vehicle_mga' => $vehicleMga,
            'chauffeur_mga' => $chauffeurMga,
            'pickup_fee_mga' => $pickupFee,
            'dropoff_fee_mga' => $dropoffFee,
            'total_mga' => $vehicleMga + $chauffeurMga + $pickupFee + $dropoffFee,
        ];
    }
}
