<?php

use App\Models\CmsModule;
use App\Models\CmsModulePermission;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $parent = CmsModule::query()->where('route_name', 'contact-module')->first();

        if (! $parent) {
            return;
        }

        $module = CmsModule::updateOrCreate(
            ['route_name' => 'warranty-requests.index'],
            [
                'name' => 'Warranty Requests',
                'icon' => 'fa-solid fa-shield-halved',
                'sort_order' => 4,
                'status' => 'active',
                'parent_id' => $parent->id,
            ]
        );

        CmsModulePermission::updateOrCreate(
            [
                'role' => 'admin',
                'module_id' => $module->id,
            ],
            [
                'is_view' => 1,
                'is_add' => 1,
                'is_update' => 1,
                'is_delete' => 1,
                'status' => 'active',
            ]
        );
    }

    public function down(): void
    {
        $module = CmsModule::query()->where('route_name', 'warranty-requests.index')->first();

        if (! $module) {
            return;
        }

        CmsModulePermission::query()->where('module_id', $module->id)->delete();
        $module->delete();
    }
};
