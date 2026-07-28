<?php

namespace App\Http\Controllers;

use App\Models\GalleryAlbum;
use App\Services\SiteContentService;
use Illuminate\View\View;

class GalleryDetailController extends Controller
{
    public function __invoke(string $slug, SiteContentService $siteContent): View
    {
        $album = GalleryAlbum::query()
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('app', [
            'page' => 'work-gallery',
            'siteContent' => $siteContent->getPayload(),
            'metaTitle' => $album->title.' — Creative Granite & Design',
            'metaDescription' => 'Photo gallery: '.$album->title.' by Creative Granite & Design.',
        ]);
    }
}
