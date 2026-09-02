<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Services\SiteContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MaterialDetailController extends Controller
{
    public function __invoke(Material $material, SiteContentService $siteContent): View|RedirectResponse
    {
        abort_unless($material->is_active, 404);

        // Informational callouts are not dedicated material pages.
        if ($material->is_callout) {
            return redirect('/#materials');
        }

        return view('app', [
            'page' => 'material-detail',
            'siteContent' => $siteContent->getPayload(),
            'metaTitle' => ($material->meta_title ?: $material->name.' Countertops Utah').' — Creative Granite & Design',
            'metaDescription' => $material->meta_description ?: ($material->tagline ?: $material->description),
        ]);
    }
}
