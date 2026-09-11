<?php

namespace App\Http\Controllers;

use App\Services\SiteContentService;
use Illuminate\View\View;

class RemnantsController extends Controller
{
    public function __invoke(SiteContentService $siteContent): View
    {
        return view('app', [
            'page' => 'remnants',
            'siteContent' => $siteContent->getPayload(),
        ]);
    }
}
