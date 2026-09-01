<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Services\SiteContentService;
use Illuminate\View\View;

class MaterialDetailController extends Controller
{
    public function __invoke(Material $material, SiteContentService $siteContent): View
    {
        abort_unless($material->is_active, 404);

        return view('app', [
            'page' => 'material-detail',
            'siteContent' => $siteContent->getPayload(),
            'metaTitle' => ($material->meta_title ?: $material->name.' Countertops Utah').' — Creative Granite & Design',
            'metaDescription' => $material->meta_description ?: ($material->tagline ?: $material->description),
        ]);
    }
}
