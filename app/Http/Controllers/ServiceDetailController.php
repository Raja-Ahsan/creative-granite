<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\SiteContentService;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceDetailController extends Controller
{
    public function __invoke(Service $service, SiteContentService $siteContent): View
    {
        abort_unless($service->is_active, 404);

        $excerpt = $service->excerpt ?: Str::limit(strip_tags($service->body), 220);

        return view('app', [
            'page' => 'service-detail',
            'siteContent' => $siteContent->getPayload(),
            'service' => [
                'title' => $service->title,
                'slug' => $service->slug,
                'body' => $service->body,
                'excerpt' => $excerpt,
                'mainImage' => $service->main_image_path,
            ],
            'metaTitle' => ($service->meta_title ?: $service->title).' — Creative Granite & Design',
            'metaDescription' => $service->meta_description ?: $excerpt,
        ]);
    }
}
