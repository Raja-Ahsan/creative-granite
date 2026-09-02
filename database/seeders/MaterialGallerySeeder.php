<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\MaterialImage;
use Illuminate\Database\Seeder;

class MaterialGallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            'marble' => [
                ['/materials/marble.jpg', 'Marble slab — natural veining detail'],
                ['/images/work/bathrooms-cover.jpg', 'Marble vanity in a finished bathroom'],
                ['/images/work/kitchens-cover.jpg', 'Marble kitchen countertop application'],
                ['/images/work/fireplaces-cover.jpg', 'Marble fireplace surround'],
            ],
            'quartzite' => [
                ['/materials/quartzite.jpg', 'Quartzite slab — movement and depth'],
                ['/images/work/lancaster-cover.jpg', 'Quartzite kitchen installation'],
                ['/images/work/norfolk-cover.jpg', 'Quartzite project surface detail'],
                ['/images/work/sabal-cover.png', 'Quartzite in a residential space'],
            ],
            'granite' => [
                ['/materials/granite.png', 'Granite slab — color and pattern variation'],
                ['/portfolio/High-End-Granite.jpg', 'High-end granite countertop'],
                ['/images/work/multifamily-cover.jpg', 'Granite for multifamily projects'],
                ['/images/work/parade-home-cover.jpg', 'Granite parade home kitchen'],
            ],
            'quartz' => [
                ['/materials/quartz.png', 'Quartz surface — consistent engineered design'],
                ['/portfolio/Solid-Surface-Countertop.jpg', 'Quartz solid surface countertop'],
                ['/images/work/bathrooms-cover.jpg', 'Quartz bathroom vanity'],
                ['/images/work/kitchens-cover.jpg', 'Quartz kitchen installation'],
            ],
        ];

        foreach ($galleries as $slug => $images) {
            $material = Material::query()->where('slug', $slug)->where('is_callout', false)->first();
            if (! $material) {
                continue;
            }

            MaterialImage::query()->where('material_id', $material->id)->delete();

            foreach ($images as $index => [$path, $alt]) {
                MaterialImage::create([
                    'material_id' => $material->id,
                    'image_path' => $path,
                    'alt_text' => $alt,
                    'sort_order' => $index + 1,
                ]);
            }
        }
    }
}
