<?php

namespace App\Http\Controllers;

use App\Services\SiteContentService;
use Illuminate\View\View;

class ProcessController extends Controller
{
    public function __invoke(SiteContentService $siteContent): View
    {
        return view('app', [
            'page' => 'process',
            'siteContent' => $siteContent->getPayload(),
        ]);
    }
}
