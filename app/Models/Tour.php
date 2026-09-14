<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title_fr', 'title_en', 'summary_fr', 'summary_en', 'duration_days',
        'default_vehicle_category', 'includes_driver', 'includes_hotels', 'price_unit',
        'base_price_mga', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'includes_driver' => 'boolean',
            'includes_hotels' => 'boolean',
            'is_published' => 'boolean',
            'base_price_mga' => 'integer',
        ];
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function title(string $locale = 'fr'): string
    {
        return $locale === 'en' ? $this->title_en : $this->title_fr;
    }
}
