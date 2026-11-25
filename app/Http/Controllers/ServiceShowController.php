<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceGuide;
use App\Services\SiteContentService;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceShowController extends Controller
{
    public function __invoke(string $slug, SiteContentService $siteContent): View
    {
        $guide = ServiceGuide::query()
            ->with(['materials', 'steps', 'faqs', 'buttons'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if ($guide) {
            $payload = $guide->toFrontendPayload();

            return view('app', [
                'page' => 'service-guide',
                'siteContent' => $siteContent->getPayload(),
                'serviceGuide' => $payload,
                'metaTitle' => $guide->meta_title ?: ($guide->title.' — Creative Granite & Design'),
                'metaDescription' => $guide->meta_description
                    ?: Str::limit(strip_tags((string) $guide->materials_intro), 160),
            ]);
        }

        $service = Service::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

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
