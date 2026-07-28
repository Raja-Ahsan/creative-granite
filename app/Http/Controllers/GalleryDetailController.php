<?php

namespace App\Http\Controllers;

use App\Services\SiteContentService;
use Illuminate\View\View;

class GalleryDetailController extends Controller
{
    private const SLUGS = [
        'kitchens',
        'bathrooms',
        'fireplaces',
        'multifamily',
        'norfolk',
        'sabal',
        'lancaster',
        '2026-parade-home',
    ];

    public function __invoke(string $slug, SiteContentService $siteContent): View
    {
        abort_unless(in_array($slug, self::SLUGS, true), 404);

        $titles = [
            'kitchens' => 'Kitchens',
            'bathrooms' => 'Bathrooms',
            'fireplaces' => 'Fireplaces',
            'multifamily' => 'Multifamily',
            'norfolk' => 'Norfolk',
            'sabal' => 'Sabal',
            'lancaster' => 'Lancaster',
            '2026-parade-home' => '2026 Parade Home',
        ];

        $title = $titles[$slug] ?? 'Our Work';

        return view('app', [
            'page' => 'work-gallery',
            'siteContent' => $siteContent->getPayload(),
            'metaTitle' => $title.' — Creative Granite & Design',
            'metaDescription' => 'Photo gallery: '.$title.' by Creative Granite & Design.',
        ]);
    }
}
