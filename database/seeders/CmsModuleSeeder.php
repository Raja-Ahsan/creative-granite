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
                'name' => 'Contact',
                'icon' => 'fa-solid fa-inbox',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $siteContent = CmsModule::updateOrCreate(
            ['route_name' => 'site-content-module'],
            [
                'name' => 'Site Content',
                'icon' => 'fa-solid fa-globe',
                'sort_order' => 3,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $modules = [
            ['hero-slides.index', 'Hero Slides', 'fa-solid fa-images', 1],
            ['materials.index', 'Materials', 'fa-solid fa-gem', 2],
            ['portfolio-items.index', 'Portfolio', 'fa-solid fa-camera', 3],
            ['services.index', 'Services', 'fa-solid fa-briefcase', 4],
            ['site-settings.edit', 'Site Settings', 'fa-solid fa-gear', 5],
            ['email-settings.edit', 'Email Settings', 'fa-solid fa-envelope', 6],
            ['email-templates.index', 'Email Templates', 'fa-solid fa-envelope-open-text', 7],
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
            ['admin.dashboard', 'contact-inquiries.index', 'site-content-module'],
            array_column($modules, 0)
        );

        CmsModule::query()
            ->where(function ($q) use ($allowed) {
                $q->whereNotIn('route_name', $allowed)->orWhereNull('route_name');
            })
            ->delete();
    }
}
