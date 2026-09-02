<?php

namespace App\Models;

use App\Models\Concerns\GeneratesSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use GeneratesSlug;

    protected string $slugSource = 'name';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'tagline',
        'intro',
        'why_choose',
        'what_to_know',
        'best_for',
        'care_guide_url',
        'care_guide_label',
        'meta_title',
        'meta_description',
        'why_choose_heading',
        'cta_eyebrow',
        'cta_heading',
        'cta_body',
        'cta_primary_label',
        'cta_secondary_label',
        'cta_secondary_url',
        'image_path',
        'sort_order',
        'is_featured',
        'is_callout',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_callout' => 'boolean',
            'sort_order' => 'integer',
            'why_choose' => 'array',
        ];
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function portfolioItems(): HasMany
    {
        return $this->hasMany(PortfolioItem::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(MaterialImage::class)->orderBy('sort_order')->orderBy('id');
    }
}
