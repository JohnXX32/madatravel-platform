<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    public const CATEGORIES = ['sedan', 'suv_4x4', 'minibus'];

    protected $fillable = [
        'slug', 'category', 'brand', 'model', 'year', 'seats', 'transmission', 'fuel',
        'has_ac', 'suitable_for_piste', 'status', 'daily_rate_mga', 'chauffeur_daily_rate_mga',
        'deposit_mga', 'description_fr', 'description_en',
    ];

    protected function casts(): array
    {
        return [
            'has_ac' => 'boolean',
            'suitable_for_piste' => 'boolean',
            'daily_rate_mga' => 'integer',
            'chauffeur_daily_rate_mga' => 'integer',
            'deposit_mga' => 'integer',
        ];
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function displayName(): string
    {
        return trim($this->brand.' '.$this->model);
    }
}
