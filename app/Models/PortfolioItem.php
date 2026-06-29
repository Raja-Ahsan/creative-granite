<?php

namespace App\Models;

use App\Models\Concerns\GeneratesSlug;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use GeneratesSlug;

    protected string $slugSource = 'title';

    protected $fillable = [
        'title',
        'slug',
        'image_path',
    ];
}
