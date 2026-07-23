<?php

namespace Database\Seeders;

use App\Models\CmsModule;
use Illuminate\Database\Seeder;

class CmsModuleSeeder extends Seeder
{
    public function run(): void
    {
        $dashboard = CmsModule::updateOrCreate(
            ['route_name' => 'admin.dashboard'],
            [
                'name' => 'Dashboard',
                'icon' => 'fa-regular fa-house',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'contact-inquiries.index'],
            [
                'name' => 'Contact Enquiries',
                'icon' => 'fa-solid fa-inbox',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'contact-page.edit'],
            [
                'name' => 'Contact Page',
                'icon' => 'fa-solid fa-address-card',
                'sort_order' => 3,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'estimate-requests.index'],
            [
                'name' => 'Estimate Requests',
                'icon' => 'fa-solid fa-file-invoice',
                'sort_order' => 4,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $siteContent = CmsModule::updateOrCreate(
            ['route_name' => 'site-content-module'],
            [
                'name' => 'Site Content',
                'icon' => 'fa-solid fa-globe',
                'sort_order' => 5,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $modules = [
            ['who-we-are.edit', 'Who We Are', 'fa-solid fa-people-group', 1],
            ['hero-slides.index', 'Hero Slides', 'fa-solid fa-images', 2],
            ['instagram-posts.index', 'Instagram Feed', 'fa-brands fa-instagram', 3],
            ['materials.index', 'Materials', 'fa-solid fa-gem', 4],
            ['products.index', 'Products', 'fa-solid fa-box', 5],
            ['process-steps.index', 'Process', 'fa-solid fa-list-ol', 6],
            ['portfolio-items.index', 'Our Work Gallery', 'fa-solid fa-camera', 7],
            ['services.index', 'Services', 'fa-solid fa-briefcase', 8],
            ['site-settings.edit', 'Site Settings', 'fa-solid fa-gear', 9],
            ['email-settings.edit', 'Email Settings', 'fa-solid fa-envelope', 10],
            ['email-templates.index', 'Email Templates', 'fa-solid fa-envelope-open-text', 11],
        ];

        foreach ($modules as [$route, $name, $icon, $order]) {
            CmsModule::updateOrCreate(
                ['route_name' => $route],
                [
                    'name' => $name,
                    'icon' => $icon,
                    'sort_order' => $order,
                    'status' => 'active',
                    'parent_id' => $siteContent->id,
                ]
            );
        }

        $allowed = array_merge(
            ['admin.dashboard', 'contact-inquiries.index', 'contact-page.edit', 'estimate-requests.index', 'site-content-module'],
            array_column($modules, 0)
        );

        CmsModule::query()
            ->where(function ($q) use ($allowed) {
                $q->whereNotIn('route_name', $allowed)->orWhereNull('route_name');
            })
            ->delete();
    }
}
