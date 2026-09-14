<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        $brand = fake()->randomElement(['Toyota', 'Hyundai', 'Peugeot']);
        $model = fake()->randomElement(['Hilux', 'Land Cruiser', 'i20', 'Partner']);

        return [
            'slug' => Str::slug($brand.' '.$model.' '.fake()->unique()->numerify('###')),
            'category' => fake()->randomElement(Vehicle::CATEGORIES),
            'brand' => $brand,
            'model' => $model,
            'year' => 2020,
            'seats' => 5,
            'transmission' => 'manual',
            'fuel' => 'diesel',
            'has_ac' => true,
            'suitable_for_piste' => true,
            'status' => 'available',
            'daily_rate_mga' => 250000,
            'chauffeur_daily_rate_mga' => 80000,
            'deposit_mga' => 500000,
        ];
    }
}
