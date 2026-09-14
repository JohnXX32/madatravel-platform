<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (class_exists(User::class)) {
            User::factory()->create([
                'name' => 'MadaTravel Admin',
                'email' => 'admin@madatravel.mg',
            ]);
        }

        $this->call(DemoCatalogSeeder::class);
    }
}
