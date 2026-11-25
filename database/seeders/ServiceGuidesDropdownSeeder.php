<?php

namespace Database\Seeders;

use App\Models\ServiceGuide;
use App\Services\SiteContentService;
use Illuminate\Database\Seeder;

/**
 * Ensures Services dropdown + Service Area pages exist with matching slugs.
 *
 * Dropdown (show_in_nav = yes, is_service_area = no):
 * 1. residential-countertops-in-utah
 * 2. commercial-countertops-utah
 * 3. countertop-remodel-utah
 * 4. kitchen-countertops-utah
 * 5. bathroom-countertops-utah
 *
 * Service Area (show_in_nav = no, is_service_area = yes):
 * - countertop-installation-idaho
 * - countertop-installation-colorado
 * - countertop-installation-in-wyoming
 *
 * Existing guides are NEVER overwritten / deleted.
 * Missing guides are created via ServiceGuideSeeder (safe skip-if-exists).
 */
class ServiceGuidesDropdownSeeder extends Seeder
{
    public function run(): void
    {
        // Create any missing guides with full SEO content (skips existing).
        $this->call(ServiceGuideSeeder::class);

        $dropdown = [
            1 => 'residential-countertops-in-utah',
            2 => 'commercial-countertops-utah',
            3 => 'countertop-remodel-utah',
            4 => 'kitchen-countertops-utah',
            5 => 'bathroom-countertops-utah',
        ];

        foreach ($dropdown as $order => $slug) {
            // Only touch nav flags / order — never title, body, images, FAQs, etc.
            ServiceGuide::query()
                ->where('slug', $slug)
                ->update([
                    'show_in_nav' => true,
                    'is_service_area' => false,
                    'is_active' => true,
                    'sort_order' => $order,
                ]);
        }

        $serviceAreas = [
            6 => 'countertop-installation-idaho',
            7 => 'countertop-installation-colorado',
            8 => 'countertop-installation-in-wyoming',
        ];

        foreach ($serviceAreas as $order => $slug) {
            ServiceGuide::query()
                ->where('slug', $slug)
                ->update([
                    'show_in_nav' => false,
                    'is_service_area' => true,
                    'is_active' => true,
                    'sort_order' => $order,
                ]);
        }

        SiteContentService::clearCache();
    }
}
