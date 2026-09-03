<?php

namespace Database\Seeders;

use App\Models\CmsModule;
use Illuminate\Database\Seeder;

class CmsModuleSeeder extends Seeder
{
    public function run(): void
    {
        $this->upsertRoot('admin.dashboard', 'Dashboard', 'fa-regular fa-house', 1);

        $home = $this->upsertRoot('home-module', 'Home Page', 'fa-solid fa-house-chimney', 2);
        $gallery = $this->upsertRoot('gallery-module', 'Gallery Page', 'fa-solid fa-images', 3);
        $productsPage = $this->upsertRoot('products-module', 'Products', 'fa-solid fa-box', 4);
        $servicesPage = $this->upsertRoot('services-module', 'Services Page', 'fa-solid fa-briefcase', 5);
        $processPage = $this->upsertRoot('process-module', 'Process Page', 'fa-solid fa-list-ol', 6);
        $contact = $this->upsertRoot('contact-module', 'Contact & Leads', 'fa-solid fa-address-book', 7);
        $settings = $this->upsertRoot('settings-module', 'Settings', 'fa-solid fa-gear', 8);

        $groups = [
            $home->id => [
                ['hero-slides.index', 'Hero Banner', 'fa-solid fa-panorama', 1],
                ['who-we-are.edit', 'Who We Are', 'fa-solid fa-people-group', 2],
                ['materials.index', 'Materials', 'fa-solid fa-gem', 3],
                ['materials-page.edit', 'Materials Section', 'fa-solid fa-sliders', 4],
                ['portfolio-items.index', 'Our Work Collage', 'fa-solid fa-camera', 5],
                ['instagram-posts.index', 'Instagram Feed', 'fa-brands fa-instagram', 6],
                ['services.index', 'Homepage Services', 'fa-solid fa-list', 7],
            ],
            $gallery->id => [
                ['gallery-albums.index', 'Gallery Albums', 'fa-solid fa-table-cells-large', 1],
            ],
            $productsPage->id => [
                ['products.index', 'All Products', 'fa-solid fa-list', 1],
                ['products-page.edit', 'Page Settings', 'fa-solid fa-sliders', 2],
                ['product-categories.index', 'Categories', 'fa-solid fa-tags', 3],
                ['edge-profiles.index', 'Edge Profiles', 'fa-solid fa-vector-square', 4],
            ],
            $servicesPage->id => [
                ['services-page.edit', 'Page Settings', 'fa-solid fa-sliders', 1],
                ['service-page-sections.index', 'Page Sections', 'fa-solid fa-layer-group', 2],
            ],
            $processPage->id => [
                ['process-steps.index', 'Process Steps', 'fa-solid fa-list-check', 1],
            ],
            $contact->id => [
                ['contact-page.edit', 'Contact Page', 'fa-solid fa-address-card', 1],
                ['contact-inquiries.index', 'Contact Enquiries', 'fa-solid fa-inbox', 2],
                ['estimate-requests.index', 'Estimate Requests', 'fa-solid fa-file-invoice', 3],
            ],
            $settings->id => [
                ['site-settings.edit', 'Site Settings', 'fa-solid fa-sliders', 1],
                ['email-settings.edit', 'Email Settings', 'fa-solid fa-envelope', 2],
                ['email-templates.index', 'Email Templates', 'fa-solid fa-envelope-open-text', 3],
            ],
        ];

        $childRoutes = [];

        foreach ($groups as $parentId => $children) {
            foreach ($children as [$route, $name, $icon, $order]) {
                $childRoutes[] = $route;
                CmsModule::updateOrCreate(
                    ['route_name' => $route],
                    [
                        'name' => $name,
                        'icon' => $icon,
                        'sort_order' => $order,
                        'status' => 'active',
                        'parent_id' => $parentId,
                    ]
                );
            }
        }

        $allowed = array_merge(
            [
                'admin.dashboard',
                'home-module',
                'gallery-module',
                'products-module',
                'services-module',
                'process-module',
                'contact-module',
                'settings-module',
            ],
            $childRoutes
        );

        CmsModule::query()
            ->where(function ($q) use ($allowed) {
                $q->whereNotIn('route_name', $allowed)->orWhereNull('route_name');
            })
            ->delete();
    }

    private function upsertRoot(string $routeName, string $name, string $icon, int $order): CmsModule
    {
        return CmsModule::updateOrCreate(
            ['route_name' => $routeName],
            [
                'name' => $name,
                'icon' => $icon,
                'sort_order' => $order,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );
    }
}
