<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait GeneratesSlug
{
    protected static function bootGeneratesSlug(): void
    {
        static::creating(function (Model $model) {
            if (! empty($model->slug)) {
                return;
            }

            $source = $model->resolveSlugSource();

            if (filled($source)) {
                $model->slug = static::makeUniqueSlug($source, $model);
            }
        });
    }

    protected function resolveSlugSource(): ?string
    {
        $column = property_exists($this, 'slugSource') ? $this->slugSource : 'name';

        return $this->{$column} ?? null;
    }

    protected static function makeUniqueSlug(string $source, Model $model): string
    {
        $slug = Str::slug($source);
        $original = $slug;
        $counter = 1;

        while (
            static::query()
                ->when($model->exists, fn ($query) => $query->whereKeyNot($model->getKey()))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $original.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
