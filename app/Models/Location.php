<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'is_airport', 'extra_fee_mga', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_airport' => 'boolean',
            'is_active' => 'boolean',
            'extra_fee_mga' => 'integer',
        ];
    }

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
