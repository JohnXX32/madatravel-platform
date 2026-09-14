<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Location;
use App\Models\Setting;
use App\Models\Tour;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DemoCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $ivato = Location::query()->create([
            'name' => 'Aéroport Ivato',
            'city' => 'Antananarivo',
            'is_airport' => true,
            'extra_fee_mga' => 40000,
        ]);
        $tana = Location::query()->create([
            'name' => 'Centre-ville Antananarivo',
            'city' => 'Antananarivo',
            'is_airport' => false,
            'extra_fee_mga' => 0,
        ]);
        $nosy = Location::query()->create([
            'name' => 'Nosy Be (Hell-Ville)',
            'city' => 'Nosy Be',
            'is_airport' => false,
            'extra_fee_mga' => 80000,
        ]);

        $vehicles = [
            ['slug' => 'toyota-hilux-4x4', 'category' => 'suv_4x4', 'brand' => 'Toyota', 'model' => 'Hilux', 'year' => 2021, 'seats' => 5, 'suitable_for_piste' => true, 'daily_rate_mga' => 280000, 'chauffeur_daily_rate_mga' => 90000, 'deposit_mga' => 800000, 'description_fr' => '4x4 fiable pour RN7, pistes et familles.', 'description_en' => 'Reliable 4x4 for RN7, dirt roads and families.'],
            ['slug' => 'toyota-land-cruiser', 'category' => 'suv_4x4', 'brand' => 'Toyota', 'model' => 'Land Cruiser', 'year' => 2019, 'seats' => 7, 'suitable_for_piste' => true, 'daily_rate_mga' => 380000, 'chauffeur_daily_rate_mga' => 100000, 'deposit_mga' => 1200000, 'description_fr' => 'Le standard des longs circuits.', 'description_en' => 'Standard for long tours.'],
            ['slug' => 'hyundai-i20', 'category' => 'sedan', 'brand' => 'Hyundai', 'model' => 'i20', 'year' => 2022, 'seats' => 5, 'suitable_for_piste' => false, 'daily_rate_mga' => 120000, 'chauffeur_daily_rate_mga' => 70000, 'deposit_mga' => 400000, 'description_fr' => 'Citadine Tana et axes bitumés.', 'description_en' => 'City car for paved roads.'],
            ['slug' => 'hyundai-h1-minibus', 'category' => 'minibus', 'brand' => 'Hyundai', 'model' => 'H1', 'year' => 2020, 'seats' => 9, 'suitable_for_piste' => false, 'daily_rate_mga' => 320000, 'chauffeur_daily_rate_mga' => 90000, 'deposit_mga' => 900000, 'description_fr' => 'Groupes et transferts aéroport.', 'description_en' => 'Groups and airport transfers.'],
        ];

        foreach ($vehicles as $data) {
            Vehicle::query()->create($data)->locations()->attach([$ivato->id, $tana->id, $nosy->id]);
        }

        Driver::query()->create(['name' => 'Jean Rakoto', 'phone' => '+261 32 00 000 01', 'languages' => ['fr', 'mg', 'en'], 'status' => 'active']);

        Tour::query()->create(['slug' => 'rn7-classique-10j', 'title_fr' => 'RN7 classique — 10 jours', 'title_en' => 'Classic RN7 — 10 days', 'summary_fr' => 'Tana, Antsirabe, Ranomafana, Isalo, Ifaty.', 'summary_en' => 'Tana to Ifaty via RN7.', 'duration_days' => 10, 'default_vehicle_category' => 'suv_4x4', 'includes_driver' => true, 'includes_hotels' => false, 'price_unit' => 'vehicle', 'base_price_mga' => 4500000]);
        Tour::query()->create(['slug' => 'tsingy-baobabs-6j', 'title_fr' => 'Tsingy & Baobabs — 6 jours', 'title_en' => 'Tsingy & Baobabs — 6 days', 'summary_fr' => 'Morondava, Baobabs, Bemaraha.', 'summary_en' => 'Morondava, Baobabs, Bemaraha.', 'duration_days' => 6, 'default_vehicle_category' => 'suv_4x4', 'includes_driver' => true, 'includes_hotels' => false, 'price_unit' => 'vehicle', 'base_price_mga' => 3200000]);
        Tour::query()->create(['slug' => 'nosy-be-plage-7j', 'title_fr' => 'Nosy Be — 7 jours', 'title_en' => 'Nosy Be — 7 days', 'summary_fr' => 'Plage et excursions îles.', 'summary_en' => 'Beach and island trips.', 'duration_days' => 7, 'default_vehicle_category' => 'sedan', 'includes_driver' => false, 'includes_hotels' => false, 'price_unit' => 'person', 'base_price_mga' => 900000]);

        Setting::query()->updateOrCreate(['key' => 'whatsapp_number'], ['value' => '261320000000']);
        Setting::query()->updateOrCreate(['key' => 'company_name'], ['value' => 'MadaTravel']);
        Setting::query()->updateOrCreate(['key' => 'contact_email'], ['value' => 'reservation@madatravel.mg']);
        Setting::query()->updateOrCreate(['key' => 'eur_to_mga'], ['value' => '5000']);
    }
}
