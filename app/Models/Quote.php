<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    protected $fillable = ['lead_id', 'booking_id', 'payload', 'total_mga', 'total_eur', 'pdf_path', 'sent_at'];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'total_mga' => 'integer',
            'total_eur' => 'integer',
            'sent_at' => 'datetime',
        ];
    }

    public function lead(): BelongsTo { return $this->belongsTo(Lead::class); }
    public function booking(): BelongsTo { return $this->belongsTo(Booking::class); }
}
