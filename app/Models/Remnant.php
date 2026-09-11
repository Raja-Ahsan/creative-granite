<?php

namespace App\Models;

use App\Models\Concerns\GeneratesSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Remnant extends Model
{
    use GeneratesSlug;

    protected string $slugSource = 'name';

    protected $fillable = [
        'name',
        'slug',
        'material',
        'finish',
        'dimensions',
        'thickness',
        'remnant_code',
        'quantity',
        'description',
        'suitability',
        'price_label',
        'image_path',
        'is_available',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'quantity' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }
}
