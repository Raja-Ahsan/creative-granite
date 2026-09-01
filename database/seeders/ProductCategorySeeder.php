<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /** @var list<array{name: string, short_name: string|null, sort_order: int}> */
    private const DEFAULT_CATEGORIES = [
        ['name' => 'Stainless Steel', 'short_name' => null, 'sort_order' => 1],
        ['name' => 'Porcelain', 'short_name' => null, 'sort_order' => 2],
        ['name' => 'Fireclay', 'short_name' => null, 'sort_order' => 3],
        ['name' => 'Quartz Composite', 'short_name' => null, 'sort_order' => 4],
    ];

    public function run(): void
    {
        foreach (self::DEFAULT_CATEGORIES as $category) {
            ProductCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'short_name' => $category['short_name'],
                    'sort_order' => $category['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        $categoriesByName = ProductCategory::query()
            ->get()
            ->keyBy(fn (ProductCategory $category) => Str::lower($category->name));

        Product::query()
            ->whereNull('product_category_id')
            ->whereNotNull('material')
            ->each(function (Product $product) use ($categoriesByName) {
                $category = $categoriesByName->get(Str::lower((string) $product->material));

                if (! $category) {
                    $category = ProductCategory::create([
                        'name' => $product->material,
                        'slug' => Str::slug($product->material),
                        'sort_order' => ((int) ProductCategory::query()->max('sort_order')) + 1,
                        'is_active' => true,
                    ]);

                    $categoriesByName->put(Str::lower($category->name), $category);
                }

                $product->update([
                    'product_category_id' => $category->id,
                    'material' => $category->name,
                ]);
            });
    }
}
