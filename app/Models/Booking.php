<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    public const BLOCKING_STATUSES = ['confirmed', 'active'];

    protected $fillable = [
        'lead_id', 'vehicle_id', 'driver_id', 'start_on', 'end_on', 'status',
        'total_mga', 'currency_quoted', 'fx_rate_to_eur', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'start_on' => 'date',
            'end_on' => 'date',
            'total_mga' => 'integer',
            'fx_rate_to_eur' => 'decimal:4',
        ];
    }

    public function vehicle(): BelongsTo { return $this->belongsTo(Vehicle::class); }
    public function driver(): BelongsTo { return $this->belongsTo(Driver::class); }
    public function lead(): BelongsTo { return $this->belongsTo(Lead::class); }

    public function isBlocking(): bool
    {
        return in_array($this->status, self::BLOCKING_STATUSES, true);
    }
}
