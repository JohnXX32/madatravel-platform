<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'vehicle_id', 'tour_id', 'start_on', 'end_on', 'pickup_location_id',
        'dropoff_location_id', 'pax', 'with_driver', 'customer_name', 'email', 'phone',
        'locale', 'message', 'source', 'status',
    ];

    protected function casts(): array
    {
        return [
            'start_on' => 'date',
            'end_on' => 'date',
            'with_driver' => 'boolean',
            'pax' => 'integer',
        ];
    }

    public function vehicle(): BelongsTo { return $this->belongsTo(Vehicle::class); }
    public function tour(): BelongsTo { return $this->belongsTo(Tour::class); }
    public function pickupLocation(): BelongsTo { return $this->belongsTo(Location::class, 'pickup_location_id'); }
    public function dropoffLocation(): BelongsTo { return $this->belongsTo(Location::class, 'dropoff_location_id'); }
    public function quotes(): HasMany { return $this->hasMany(Quote::class); }
    public function bookings(): HasMany { return $this->hasMany(Booking::class); }
}
