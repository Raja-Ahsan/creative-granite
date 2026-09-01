<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;

class ProductController extends Controller
{
    use HandlesImageUpload;

    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $material = trim($request->string('material')->toString());
        $categoryId = $request->integer('category');
        $active = $request->string('active')->toString();
        $sort = $request->string('sort')->toString() ?: 'sort_order';
        $direction = strtolower($request->string('direction')->toString()) === 'desc' ? 'desc' : 'asc';

        $allowedSorts = ['sort_order', 'model', 'name', 'material', 'created_at', 'id'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'sort_order';
        }

        $query = Product::query()->with('category')->withCount('images');

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('model', 'like', '%'.$search.'%')
                    ->orWhere('name', 'like', '%'.$search.'%')
                    ->orWhere('bowl_description', 'like', '%'.$search.'%')
                    ->orWhere('material', 'like', '%'.$search.'%');
            });
        }

        if ($categoryId > 0) {
            $query->where('product_category_id', $categoryId);
        } elseif ($material !== '') {
            $query->where('material', $material);
        }

        if ($active === '1') {
            $query->where('is_active', true);
        } elseif ($active === '0') {
            $query->where('is_active', false);
        }

        if ($sort === 'sort_order') {
            $query->orderBy('sort_order', $direction)->orderBy('id', $direction);
        } else {
            $query->orderBy($sort, $direction)->orderBy('sort_order')->orderBy('id');
        }

        $categories = ProductCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('screens.admin.products.index', [
            'items' => $query->paginate(12)->withQueryString(),
            'title' => 'Products',
            'filters' => [
                'search' => $search,
                'material' => $material,
                'category' => $categoryId > 0 ? (string) $categoryId : '',
                'active' => $active,
                'sort' => $sort,
                'direction' => $direction,
            ],
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        $item = new Product([
            'sort_order' => ((int) Product::query()->max('sort_order')) + 1,
            'is_active' => true,
        ]);
        $item->setRelation('images', collect());

        return view('screens.admin.products.form', [
            'item' => $item,
            'title' => 'Add Product',
            'categories' => $this->categoryOptions(),
            'availableImages' => $this->availableProductImages(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'products');
        $data['image_path'] = $data['image_path'] ?? null;
        $data['excerpt'] = ($data['excerpt'] ?? null) ?: ($data['bowl_description'] ?? null);

        if (empty($data['name']) && ! empty($data['model'])) {
            $data['name'] = $data['model'];
        }

        $product = Product::create($data);

        $this->syncVariantImages($request, $product);
        $this->syncPrimaryImage($product, $this->primaryImageExplicitlyChanged($request));

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product): View
    {
        return view('screens.admin.products.form', [
            'item' => $product->load(['images', 'category']),
            'title' => 'Edit Product',
            'categories' => $this->categoryOptions($product),
            'availableImages' => $this->availableProductImages(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validated($request, $product);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'products');

        if (! $request->hasFile('image')) {
            $data['image_path'] = $product->image_path;
        }

        $data['excerpt'] = ($data['excerpt'] ?? null) ?: ($data['bowl_description'] ?? null);

        if (empty($data['name']) && ! empty($data['model'])) {
            $data['name'] = $data['model'];
        }

        $primaryExplicitlyChanged = $this->primaryImageExplicitlyChanged($request);

        $product->update($data);

        $this->syncVariantImages($request, $product);
        $this->syncPrimaryImage($product, $primaryExplicitlyChanged);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        foreach ($product->images as $image) {
            $this->deleteStoredImage($image->image_path);
        }

        $this->deleteStoredImage($product->image_path);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $imageRules = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:12288'];

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'bowl_description' => ['nullable', 'string', 'max:500'],
            'mount' => ['nullable', 'string', 'max:120'],
            'gauge' => ['nullable', 'string', 'max:20'],
            'construction' => ['nullable', 'string', 'max:255'],
            'dimensions' => ['nullable', 'string', 'max:255'],
            'colors_finish' => ['nullable', 'string', 'max:255'],
            'optional_accessories' => ['nullable', 'string', 'max:5000'],
            'description' => ['nullable', 'string'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'image' => $imageRules,
            'existing_variants' => ['nullable', 'array'],
            'existing_variants.*.label' => ['nullable', 'string', 'max:120'],
            'existing_variants.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'remove_variants' => ['nullable', 'array'],
            'remove_variants.*' => ['integer', 'exists:product_images,id'],
            'new_variants' => ['nullable', 'array'],
            'new_variants.*.path' => ['nullable', 'string', 'max:500'],
            'new_variants.*.label' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'image.mimes' => 'Primary image must be JPG, JPEG, PNG, or WEBP.',
        ]);

        $this->validateVariantFiles($request);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['material'] = ProductCategory::query()
            ->whereKey($data['product_category_id'])
            ->value('name');

        unset(
            $data['existing_variants'],
            $data['remove_variants'],
            $data['new_variants'],
        );

        return $data;
    }

    private function validateVariantFiles(Request $request): void
    {
        $variants = $request->input('new_variants', []);
        if (! is_array($variants)) {
            return;
        }

        foreach ($variants as $index => $variant) {
            if (! $request->hasFile("new_variants.{$index}.file")) {
                continue;
            }

            $file = $request->file("new_variants.{$index}.file");
            if (! $file instanceof UploadedFile || ! $file->isValid()) {
                continue;
            }

            $request->validate([
                "new_variants.{$index}.file" => ['file', 'mimes:jpg,jpeg,png,webp', 'max:12288'],
            ], [
                "new_variants.{$index}.file.mimes" => 'Variation image must be JPG, JPEG, PNG, or WEBP.',
            ]);
        }
    }

    /** @return \Illuminate\Database\Eloquent\Collection<int, ProductCategory> */
    private function categoryOptions(?Product $product = null)
    {
        $currentCategoryId = $product?->product_category_id;

        return ProductCategory::query()
            ->where(function ($builder) use ($currentCategoryId) {
                $builder->where('is_active', true);

                if ($currentCategoryId) {
                    $builder->orWhere('id', $currentCategoryId);
                }
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    private function syncVariantImages(Request $request, Product $product): void
    {
        $removeIds = $request->input('remove_variants', []);
        if (is_array($removeIds) && $removeIds !== []) {
            ProductImage::query()
                ->where('product_id', $product->id)
                ->whereIn('id', $removeIds)
                ->get()
                ->each(function (ProductImage $image) {
                    $this->deleteStoredImage($image->image_path);
                    $image->delete();
                });
        }

        $existing = $request->input('existing_variants', []);
        if (is_array($existing)) {
            foreach ($existing as $id => $values) {
                $image = ProductImage::query()
                    ->where('product_id', $product->id)
                    ->whereKey($id)
                    ->first();

                if (! $image) {
                    continue;
                }

                $image->update([
                    'alt_text' => $values['label'] ?? $image->alt_text,
                    'sort_order' => (int) ($values['sort_order'] ?? $image->sort_order),
                ]);
            }
        }

        $startOrder = (int) $product->images()->max('sort_order');

        $newVariants = $request->input('new_variants', []);
        if (is_array($newVariants)) {
            foreach ($newVariants as $index => $variant) {
                if (! is_array($variant)) {
                    continue;
                }

                $label = trim((string) ($variant['label'] ?? ''));
                $path = trim((string) ($variant['path'] ?? ''));
                $file = $request->file("new_variants.{$index}.file");

                if ($file instanceof UploadedFile && $file->isValid()) {
                    $storedPath = $file->store('products/variants', 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => '/storage/'.$storedPath,
                        'alt_text' => $label !== '' ? $label : $this->labelFromPath($file->getClientOriginalName()),
                        'sort_order' => ++$startOrder,
                    ]);

                    continue;
                }

                if ($path === '') {
                    continue;
                }

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'alt_text' => $label !== '' ? $label : $this->labelFromPath($path),
                    'sort_order' => ++$startOrder,
                ]);
            }
        }

        if ($product->images()->count() === 0 && $product->image_path) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $product->image_path,
                'alt_text' => $this->labelFromPath($product->image_path),
                'sort_order' => 1,
            ]);
        }
    }

    private function primaryImageExplicitlyChanged(Request $request): bool
    {
        return $request->hasFile('image');
    }

    private function syncPrimaryImage(Product $product, bool $primaryExplicitlyChanged = false): void
    {
        $product->refresh()->load('images');

        if ($primaryExplicitlyChanged && filled($product->image_path)) {
            $this->promotePrimaryPathToFirstVariant($product);

            return;
        }

        $first = $product->images->sortBy('sort_order')->first();

        if ($first) {
            if ($product->image_path !== $first->image_path) {
                $product->update(['image_path' => $first->image_path]);
            }

            return;
        }

        if ($product->image_path !== null) {
            $product->update(['image_path' => null]);
        }
    }

    private function promotePrimaryPathToFirstVariant(Product $product): void
    {
        $primaryPath = (string) $product->image_path;
        $images = $product->images->sortBy('sort_order')->values();

        $matching = $images->firstWhere('image_path', $primaryPath);
        if ($matching) {
            if ((int) $matching->sort_order !== (int) $images->min('sort_order')) {
                $matching->update(['sort_order' => ((int) $images->min('sort_order')) - 1]);
            }

            return;
        }

        if ($images->isNotEmpty()) {
            foreach ($images as $image) {
                $image->update(['sort_order' => ((int) $image->sort_order) + 1]);
            }
        }

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $primaryPath,
            'alt_text' => $this->labelFromPath($primaryPath),
            'sort_order' => 1,
        ]);
    }

    private function labelFromPath(string $path): string
    {
        $filename = pathinfo($path, PATHINFO_FILENAME);

        if (preg_match('/^\d+\s+(.+)$/', $filename, $matches)) {
            return trim($matches[1]);
        }

        if (stripos($filename, 'MATTEGRAY') !== false) {
            return 'Matte Charcoal';
        }

        if (stripos($filename, 'WHITE') !== false) {
            return 'White';
        }

        return 'Standard';
    }

    /** @return list<string> */
    private function availableProductImages(): array
    {
        $directory = public_path('images/products');

        if (! is_dir($directory)) {
            return [];
        }

        return array_values(array_map(
            fn (string $file) => '/images/products/'.$file,
            array_filter(
                scandir($directory) ?: [],
                fn (string $file) => ! in_array($file, ['.', '..'], true)
                    && is_file($directory.DIRECTORY_SEPARATOR.$file)
            )
        ));
    }
}
