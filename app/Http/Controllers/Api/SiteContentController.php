<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SiteContentService;
use Illuminate\Http\JsonResponse;

class SiteContentController extends Controller
{
    public function __invoke(SiteContentService $siteContent): JsonResponse
    {
        return response()->json($siteContent->getPayload());
    }
}
