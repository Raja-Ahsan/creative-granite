<?php

namespace Database\Seeders;

use App\Models\EdgeProfile;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class EdgeProfileSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'edge_profiles_eyebrow'],
            ['value' => '', 'type' => 'string', 'group' => 'edge_profiles']
        );
        SiteSetting::updateOrCreate(
            ['key' => 'edge_profiles_heading'],
            ['value' => 'Edge Profiles', 'type' => 'string', 'group' => 'edge_profiles']
        );
        SiteSetting::updateOrCreate(
            ['key' => 'edge_profiles_body'],
            [
                'value' => 'The edge profile is a finishing detail that can subtly—or dramatically—change the look of a surface. Explore some of our most commonly requested profiles below. Our fabrication capabilities also allow us to create custom edge details tailored to the material, application, and design of your project.',
                'type' => 'string',
                'group' => 'edge_profiles',
            ]
        );
        SiteSetting::updateOrCreate(
            ['key' => 'edge_profiles_note'],
            [
                'value' => 'The edge profiles shown here represent some of our most commonly requested options and are intended as examples of what we can create. They are not a complete representation of our fabrication capabilities. We offer a variety of additional edge profiles and can work with you to create a custom profile to suit your specific design and project needs.',
                'type' => 'string',
                'group' => 'edge_profiles',
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'materials_products_heading'],
            ['value' => 'Explore Our Materials', 'type' => 'string', 'group' => 'materials_section']
        );
        SiteSetting::updateOrCreate(
            ['key' => 'materials_products_subheading'],
            [
                'value' => 'Explore our most requested natural and engineered surfaces. Each offers its own balance of character, durability, and performance.',
                'type' => 'string',
                'group' => 'materials_section',
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'products_page_heading'],
            ['value' => 'Sink Selections', 'type' => 'string', 'group' => 'products_page']
        );

        $profiles = [
            [
                'name' => 'Dupont Edge',
                'slug' => 'dupont-edge',
                'sort_order' => 1,
                'description' => 'Flat top transitioning into a sculpted curved profile.',
                'image_path' => '/images/edges/dupont-edge.jpg',
            ],
            [
                'name' => 'Eased Edge',
                'slug' => 'eased-edge',
                'sort_order' => 2,
                'description' => 'A slightly softened square edge for a clean, contemporary finish.',
                'image_path' => '/images/work/kitchens-cover.jpg',
            ],
            [
                'name' => 'Full Bullnose',
                'slug' => 'full-bullnose',
                'sort_order' => 3,
                'description' => 'A fully rounded profile that creates a soft, classic silhouette.',
                'image_path' => '/images/work/bathrooms-cover.jpg',
            ],
            [
                'name' => 'Bevel Edge',
                'slug' => 'bevel-edge',
                'sort_order' => 4,
                'description' => 'An angled face that adds architectural definition to the slab.',
                'image_path' => '/images/work/lancaster-cover.jpg',
            ],
            [
                'name' => 'Ogee Edge',
                'slug' => 'ogee-edge',
                'sort_order' => 5,
                'description' => 'An S-shaped decorative profile with traditional elegance.',
                'image_path' => '/images/work/norfolk-cover.jpg',
            ],
        ];

        foreach ($profiles as $profile) {
            EdgeProfile::updateOrCreate(
                ['slug' => $profile['slug']],
                $profile + ['is_active' => true]
            );
        }
    }
}
