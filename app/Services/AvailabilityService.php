<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Vehicle;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;

class AvailabilityService
{
    public function isVehicleAvailable(
        Vehicle $vehicle,
        CarbonInterface $startOn,
        CarbonInterface $endOn,
        ?int $ignoreBookingId = null,
    ): bool {
        if ($vehicle->status !== 'available') {
            return false;
        }

        return ! $this->overlappingQuery($vehicle->id, $startOn, $endOn, $ignoreBookingId)->exists();
    }

    public function overlappingQuery(
        int $vehicleId,
        CarbonInterface $startOn,
        CarbonInterface $endOn,
        ?int $ignoreBookingId = null,
    ): Builder {
        return Booking::query()
            ->where('vehicle_id', $vehicleId)
            ->whereIn('status', Booking::BLOCKING_STATUSES)
            ->when($ignoreBookingId, fn (Builder $q) => $q->where('id', '!=', $ignoreBookingId))
            ->whereDate('start_on', '<=', $endOn->toDateString())
            ->whereDate('end_on', '>=', $startOn->toDateString());
    }
}
