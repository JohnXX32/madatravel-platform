<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Services\AvailabilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvailabilityServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirmed_booking_blocks_overlapping_dates(): void
    {
        $vehicle = Vehicle::factory()->create();

        Booking::query()->create([
            'vehicle_id' => $vehicle->id,
            'start_on' => '2026-10-10',
            'end_on' => '2026-10-15',
            'status' => 'confirmed',
            'total_mga' => 1,
        ]);

        $service = new AvailabilityService;

        $this->assertFalse($service->isVehicleAvailable(
            $vehicle,
            now()->parse('2026-10-14'),
            now()->parse('2026-10-18'),
        ));

        $this->assertTrue($service->isVehicleAvailable(
            $vehicle,
            now()->parse('2026-10-16'),
            now()->parse('2026-10-20'),
        ));
    }
}
