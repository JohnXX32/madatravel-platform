<?php

use App\Http\Controllers\LeadController;
use App\Models\Tour;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'vehicles' => Vehicle::query()->where('status', 'available')->orderBy('daily_rate_mga')->get(),
        'tours' => Tour::query()->where('is_published', true)->orderBy('duration_days')->get(),
    ]);
});

Route::post('/demandes', [LeadController::class, 'store'])->name('leads.store');
