<?php

namespace App\Http\Controllers;

use App\Services\SiteContentService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(SiteContentService $siteContent): View
    {
        return view('app', [
            'page' => 'home',
            'siteContent' => $siteContent->getPayload(),
        ]);
    }
}
