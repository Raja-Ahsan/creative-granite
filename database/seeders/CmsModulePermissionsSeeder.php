<?php

namespace Database\Seeders;

use App\Models\CmsModule;
use App\Models\CmsModulePermission;
use Illuminate\Database\Seeder;

class CmsModulePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        CmsModulePermission::truncate();

        $adminRoutes = [
            'admin.dashboard',
            'contact-inquiries.index',
            'contact-page.edit',
            'estimate-requests.index',
            'site-content-module',
            'hero-slides.index',
            'materials.index',
            'products.index',
            'process-steps.index',
            'portfolio-items.index',
            'services.index',
            'site-settings.edit',
            'email-settings.edit',
            'email-templates.index',
        ];

        $permissions = [
            'admin' => array_fill_keys($adminRoutes, [
                'is_view' => 1,
                'is_add' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ]),
            'user' => [
                'admin.dashboard' => ['is_view' => 1, 'is_add' => 0, 'is_update' => 0, 'is_delete' => 0],
            ],
        ];

        foreach ($permissions as $role => $modules) {
            foreach ($modules as $route => $perm) {
                $module = CmsModule::where('route_name', $route)->first();
                if (! $module) {
                    continue;
                }

                CmsModulePermission::create([
                    'role' => $role,
                    'module_id' => $module->id,
                    'is_view' => $perm['is_view'],
                    'is_add' => $perm['is_add'],
                    'is_update' => $perm['is_update'],
                    'is_delete' => $perm['is_delete'],
                    'status' => 'active',
                ]);
            }
        }
    }
}
