<?php

namespace App\Http\Controllers;

use App\Services\SiteContentService;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __invoke(SiteContentService $siteContent): View
    {
        return view('app', [
            'page' => 'contact',
            'siteContent' => $siteContent->getPayload(),
        ]);
    }
}
