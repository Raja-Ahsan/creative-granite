<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Support\ProductImageMatcher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EsiSinkProductsSeeder extends Seeder
{
    public function run(): void
    {
        ProductImage::query()->delete();
        Product::query()->delete();

        foreach ($this->items() as $index => $item) {
            $model = $item['model'];
            $images = ProductImageMatcher::allImages($model);

            $product = Product::create([
                'name' => $model,
                'slug' => Str::slug($model),
                'model' => $model,
                'material' => $item['material'],
                'bowl_description' => $item['bowl_description'],
                'mount' => $item['mount'],
                'gauge' => $item['gauge'],
                'construction' => $item['construction'],
                'dimensions' => $item['dimensions'],
                'colors_finish' => $item['colors_finish'],
                'optional_accessories' => $item['optional_accessories'],
                'description' => null,
                'excerpt' => $item['bowl_description'],
                'image_path' => $images[0]['path'] ?? null,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($images as $sortOrder => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image['path'],
                    'alt_text' => $image['label'],
                    'sort_order' => $sortOrder + 1,
                ]);
            }
        }
    }

    /** @return list<array<string, string|null>> */
    private function items(): array
    {
        return [
            ['model' => 'ESI-S380-16', 'material' => 'Stainless Steel', 'bowl_description' => 'Large single bowl', 'mount' => 'Undermount', 'gauge' => '16', 'construction' => 'Type 304SS', 'dimensions' => '31-1/2" x 18-1/4" O.D. x 9" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Custom fit sink grid (ESI-S380-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)'],
            ['model' => 'ESI-S360-16', 'material' => 'Stainless Steel', 'bowl_description' => '60/40 double bowl', 'mount' => 'Undermount', 'gauge' => '16', 'construction' => 'Type 304SS', 'dimensions' => '31-3/4" x 20-5/8" O.D. x 9" / 7" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Custom fit sink grids (ESI-S360-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)'],
            ['model' => 'ESI-S360R-16', 'material' => 'Stainless Steel', 'bowl_description' => '40/60 double bowl', 'mount' => 'Undermount', 'gauge' => '16', 'construction' => 'Type 304SS', 'dimensions' => '31-3/4" x 20-5/8" O.D. x 7" / 9" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Custom fit sink grids (ESI-S360-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)'],
            ['model' => 'ESI-S330-18', 'material' => 'Stainless Steel', 'bowl_description' => 'Small single bowl', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '16-1/2" x 18" O.D. x 9" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Custom fit sink grid; silicone cutting board; strainer; drain cover'],
            ['model' => 'ESI-S320-18', 'material' => 'Stainless Steel', 'bowl_description' => 'Small single bowl', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '16" x 16" O.D. x 8" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Custom fit sink grid; silicone cutting board; strainer; drain cover'],
            ['model' => 'ESI-S310-18', 'material' => 'Stainless Steel', 'bowl_description' => 'Small single bowl', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '12-5/8" x 15" O.D. x 7" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Custom fit sink grid; silicone cutting board; strainer; drain cover'],
            ['model' => 'ESI-S225-18', 'material' => 'Stainless Steel', 'bowl_description' => '50/50 double bowl, handmade', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '31" x 18" O.D. x 9" / 9" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Not shown on photographed page'],
            ['model' => 'ESI-S275-18', 'material' => 'Stainless Steel', 'bowl_description' => 'Large single bowl, handmade', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '31-13/16" x 18-1/8" O.D. x 9" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Not shown on photographed page'],
            ['model' => 'ESI-S270-18', 'material' => 'Stainless Steel', 'bowl_description' => '40/60 double bowl, handmade', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '31-1/4" x 20-13/16" O.D. x 7" / 9" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Not shown on photographed page'],
            ['model' => 'ESI-S265-18', 'material' => 'Stainless Steel', 'bowl_description' => '60/40 double bowl, handmade', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '31-1/4" x 20-13/16" O.D. x 9" / 7" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Not shown on photographed page'],
            ['model' => 'ESI-S210-18', 'material' => 'Stainless Steel', 'bowl_description' => 'Medium single bowl', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '23" x 18" O.D. x 9" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Not shown on photographed page'],
            ['model' => 'ESI-S200-18', 'material' => 'Stainless Steel', 'bowl_description' => 'Small single bowl, handmade', 'mount' => 'Undermount', 'gauge' => '18', 'construction' => 'Type 304SS', 'dimensions' => '17-1/8" x 15-1/4" O.D. x 9" D', 'colors_finish' => 'Stainless Steel', 'optional_accessories' => 'Not shown on photographed page'],
            ['model' => 'ESI-VC12', 'material' => 'Porcelain', 'bowl_description' => 'Small oval vanity', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Porcelain', 'dimensions' => '15" x 12" I.D. x 6" D', 'colors_finish' => 'White; Bisque', 'optional_accessories' => 'Not shown'],
            ['model' => 'ESI-VC10', 'material' => 'Porcelain', 'bowl_description' => 'Large oval vanity', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Porcelain', 'dimensions' => '17-1/4" x 14" I.D. x 6-1/4" D', 'colors_finish' => 'White; Bisque', 'optional_accessories' => 'Not shown'],
            ['model' => 'ESI-VCR50', 'material' => 'Porcelain', 'bowl_description' => 'Small rectangle (eased) vanity', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Porcelain', 'dimensions' => '16" x 11" I.D. x 6" D', 'colors_finish' => 'White; Bisque', 'optional_accessories' => 'Not shown'],
            ['model' => 'ESI-VCR60', 'material' => 'Porcelain', 'bowl_description' => 'Large rectangle (eased) vanity', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Porcelain', 'dimensions' => '18" x 13" I.D. x 6" D', 'colors_finish' => 'White; Bisque', 'optional_accessories' => 'Not shown'],
            ['model' => 'ESI-FCMOD33', 'material' => 'Fireclay', 'bowl_description' => '33-inch modern smooth single bowl', 'mount' => 'Apron-front', 'gauge' => null, 'construction' => 'Fireclay', 'dimensions' => '33" x 19" O.D. x 10" D', 'colors_finish' => 'White; Matte Charcoal', 'optional_accessories' => 'Custom sink grid (ESI-FCMOD33-GRD)'],
            ['model' => 'ESI-FCCL332D', 'material' => 'Fireclay', 'bowl_description' => '33-inch classic smooth double bowl', 'mount' => 'Apron-front', 'gauge' => null, 'construction' => 'Fireclay', 'dimensions' => '33" x 18" O.D. x 10" / 10" D', 'colors_finish' => 'White; Matte Charcoal', 'optional_accessories' => 'Custom sink grid (ESI-FCCL332D-GRD)'],
            ['model' => 'ESI-FCMOD36', 'material' => 'Fireclay', 'bowl_description' => '36-inch modern smooth single bowl', 'mount' => 'Apron-front', 'gauge' => null, 'construction' => 'Fireclay', 'dimensions' => '36" x 19" O.D. x 10" D', 'colors_finish' => 'White; Matte Charcoal', 'optional_accessories' => 'Custom sink grid (ESI-FCMOD36-GRD)'],
            ['model' => 'ESI-FCMOD362D', 'material' => 'Fireclay', 'bowl_description' => '36-inch modern smooth double bowl', 'mount' => 'Apron-front', 'gauge' => null, 'construction' => 'Fireclay', 'dimensions' => '36" x 19" O.D. x 10" / 10" D', 'colors_finish' => 'White; Matte Charcoal', 'optional_accessories' => 'Custom sink grid (ESI-FCMOD362D-GRD)'],
            ['model' => 'ESI-QS1000', 'material' => 'Quartz Composite', 'bowl_description' => '32-inch large single bowl', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Quartz composite', 'dimensions' => '32" x 19" O.D. x 9" D', 'colors_finish' => 'White; Black; Mocha; Concrete; Beige', 'optional_accessories' => 'Custom fit sink grid; matching strainer basket; matching disposal flange'],
            ['model' => 'ESI-QS5050', 'material' => 'Quartz Composite', 'bowl_description' => '32-inch 50/50 double equal bowl', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Quartz composite', 'dimensions' => '32" x 19" O.D. x 9" / 9" D', 'colors_finish' => 'White; Black; Mocha; Concrete; Beige', 'optional_accessories' => 'Custom fit sink grids; matching strainer basket; matching disposal flange'],
            ['model' => 'ESI-QS6040', 'material' => 'Quartz Composite', 'bowl_description' => '32-inch 60/40 large/small bowl', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Quartz composite', 'dimensions' => '32" x 19" O.D. x 9" / 7-1/2" D', 'colors_finish' => 'White; Black; Mocha; Concrete; Beige', 'optional_accessories' => 'Custom fit sink grids; matching strainer basket; matching disposal flange'],
            ['model' => 'ESI-QS1618', 'material' => 'Quartz Composite', 'bowl_description' => '16-1/2-inch small single bowl / bar sink', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Quartz composite', 'dimensions' => '16-1/2" x 18" O.D. x 8" D', 'colors_finish' => 'White; Black; Mocha; Concrete; Beige', 'optional_accessories' => 'Custom fit sink grid; matching strainer basket; matching disposal flange'],
            ['model' => 'ESI-QS2318', 'material' => 'Quartz Composite', 'bowl_description' => '23-inch medium single bowl kitchen/utility', 'mount' => 'Undermount', 'gauge' => null, 'construction' => 'Quartz composite', 'dimensions' => '23" x 18" O.D. x 8-1/2" D', 'colors_finish' => 'White; Black; Mocha; Concrete; Beige', 'optional_accessories' => 'Custom fit sink grid; matching strainer basket; matching disposal flange'],
        ];
    }
}
