<?php

namespace App\Models;

use App\Models\Concerns\GeneratesSlug;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use GeneratesSlug;

    protected string $slugSource = 'title';

    protected $fillable = [
        'title',
        'slug',
        'body',
        'excerpt',
        'main_image_path',
        'meta_title',
        'meta_description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
