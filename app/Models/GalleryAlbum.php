<?php

namespace App\Models;

use App\Models\Concerns\GeneratesSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryAlbum extends Model
{
    use GeneratesSlug;

    public const KIND_CATEGORY = 'category';

    public const KIND_PROJECT = 'project';

    protected string $slugSource = 'title';

    protected $fillable = [
        'title',
        'slug',
        'kind',
        'cover_path',
        'gallery_path',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(GalleryAlbumImage::class)->orderBy('sort_order')->orderBy('id');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeCategories(Builder $query): Builder
    {
        return $query->where('kind', self::KIND_CATEGORY);
    }

    public function scopeProjects(Builder $query): Builder
    {
        return $query->where('kind', self::KIND_PROJECT);
    }
}
