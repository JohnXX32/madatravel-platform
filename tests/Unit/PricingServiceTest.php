<?php

namespace Tests\Unit;

use App\Models\Location;
use App\Models\Vehicle;
use App\Services\PricingService;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class PricingServiceTest extends TestCase
{
    public function test_minimum_one_day_and_driver_fee(): void
    {
        $vehicle = new Vehicle([
            'daily_rate_mga' => 100000,
            'chauffeur_daily_rate_mga' => 40000,
        ]);
        $pickup = new Location(['extra_fee_mga' => 10000]);
        $dropoff = new Location(['extra_fee_mga' => 5000]);

        $quote = (new PricingService())->quoteVehicle(
            $vehicle,
            Carbon::parse('2026-09-20'),
            Carbon::parse('2026-09-20'),
            true,
            $pickup,
            $dropoff,
        );

        $this->assertSame(1, $quote['days']);
        $this->assertSame(100000, $quote['vehicle_mga']);
        $this->assertSame(40000, $quote['chauffeur_mga']);
        $this->assertSame(155000, $quote['total_mga']);
    }
}
