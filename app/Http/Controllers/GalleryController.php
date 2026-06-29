<?php

namespace App\Http\Controllers;

use App\Services\SiteContentService;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __invoke(SiteContentService $siteContent): View
    {
        return view('app', [
            'page' => 'gallery',
            'siteContent' => $siteContent->getPayload(),
        ]);
    }
}
