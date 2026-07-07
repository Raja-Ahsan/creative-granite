<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SiteContentService;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductDetailController extends Controller
{
    public function __invoke(Product $product, SiteContentService $siteContent): View
    {
        abort_unless($product->is_active, 404);

        $excerpt = $product->excerpt ?: Str::limit(strip_tags($product->description), 160);

        return view('app', [
            'page' => 'product-detail',
            'siteContent' => $siteContent->getPayload(),
            'product' => [
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description,
                'desc' => $excerpt,
                'image' => $product->image_path,
            ],
            'metaTitle' => $product->name.' — Creative Granite & Design',
            'metaDescription' => $excerpt,
        ]);
    }
}
