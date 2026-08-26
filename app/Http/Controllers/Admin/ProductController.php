<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;

class ProductController extends Controller
{
    use HandlesImageUpload;

    private const MATERIALS = [
        'Stainless Steel',
        'Porcelain',
        'Fireclay',
        'Quartz Composite',
    ];

    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $material = trim($request->string('material')->toString());
        $active = $request->string('active')->toString();
        $sort = $request->string('sort')->toString() ?: 'sort_order';
        $direction = strtolower($request->string('direction')->toString()) === 'desc' ? 'desc' : 'asc';

        $allowedSorts = ['sort_order', 'model', 'name', 'material', 'created_at', 'id'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'sort_order';
        }

        $query = Product::query()->withCount('images');

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('model', 'like', '%'.$search.'%')
                    ->orWhere('name', 'like', '%'.$search.'%')
                    ->orWhere('bowl_description', 'like', '%'.$search.'%')
                    ->orWhere('material', 'like', '%'.$search.'%');
            });
        }

        if ($material !== '') {
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

        $materials = Product::query()
            ->whereNotNull('material')
            ->where('material', '!=', '')
            ->distinct()
            ->orderBy('material')
            ->pluck('material')
            ->all();

        return view('screens.admin.products.index', [
            'items' => $query->paginate(12)->withQueryString(),
            'title' => 'Products',
            'filters' => [
                'search' => $search,
                'material' => $material,
                'active' => $active,
                'sort' => $sort,
                'direction' => $direction,
            ],
            'materialOptions' => array_values(array_unique(array_merge(self::MATERIALS, $materials))),
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
            'materialOptions' => self::MATERIALS,
            'availableImages' => $this->availableProductImages(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'products');
        $data['excerpt'] = ($data['excerpt'] ?? null) ?: ($data['bowl_description'] ?? null);

        if (empty($data['name']) && ! empty($data['model'])) {
            $data['name'] = $data['model'];
        }

        $product = Product::create($data);

        $this->syncVariantImages($request, $product);
        $this->syncPrimaryImage($product);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product): View
    {
        return view('screens.admin.products.form', [
            'item' => $product->load('images'),
            'title' => 'Edit Product',
            'materialOptions' => array_values(array_unique(array_merge(
                self::MATERIALS,
                Product::query()->whereNotNull('material')->distinct()->pluck('material')->all()
            ))),
            'availableImages' => $this->availableProductImages(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validated($request, $product);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'products');
        $data['excerpt'] = ($data['excerpt'] ?? null) ?: ($data['bowl_description'] ?? null);

        if (empty($data['name']) && ! empty($data['model'])) {
            $data['name'] = $data['model'];
        }

        $product->update($data);

        $this->syncVariantImages($request, $product);
        $this->syncPrimaryImage($product);

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
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'material' => ['nullable', 'string', 'max:255'],
            'bowl_description' => ['nullable', 'string', 'max:500'],
            'mount' => ['nullable', 'string', 'max:120'],
            'gauge' => ['nullable', 'string', 'max:20'],
            'construction' => ['nullable', 'string', 'max:255'],
            'dimensions' => ['nullable', 'string', 'max:255'],
            'colors_finish' => ['nullable', 'string', 'max:255'],
            'optional_accessories' => ['nullable', 'string', 'max:5000'],
            'description' => ['nullable', 'string'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'image_path' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'max:12288'],
            'existing_variants' => ['nullable', 'array'],
            'existing_variants.*.label' => ['nullable', 'string', 'max:120'],
            'existing_variants.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'remove_variants' => ['nullable', 'array'],
            'remove_variants.*' => ['integer', 'exists:product_images,id'],
            'variant_paths' => ['nullable', 'array'],
            'variant_paths.*' => ['nullable', 'string', 'max:500'],
            'variant_labels' => ['nullable', 'array'],
            'variant_labels.*' => ['nullable', 'string', 'max:120'],
            'variant_files' => ['nullable', 'array'],
            'variant_files.*' => ['image', 'max:12288'],
            'variant_file_labels' => ['nullable', 'array'],
            'variant_file_labels.*' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['image_path'] = filled($data['image_path'] ?? null) ? $data['image_path'] : null;

        unset(
            $data['existing_variants'],
            $data['remove_variants'],
            $data['variant_paths'],
            $data['variant_labels'],
            $data['variant_files'],
            $data['variant_file_labels'],
        );

        return $data;
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

        $paths = $request->input('variant_paths', []);
        $labels = $request->input('variant_labels', []);
        if (is_array($paths)) {
            foreach ($paths as $index => $path) {
                $path = trim((string) $path);
                if ($path === '') {
                    continue;
                }

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'alt_text' => trim((string) ($labels[$index] ?? '')) ?: $this->labelFromPath($path),
                    'sort_order' => $startOrder + $index + 1,
                ]);
            }
            $startOrder += count(array_filter($paths, fn ($path) => trim((string) $path) !== ''));
        }

        if ($request->hasFile('variant_files')) {
            foreach ($request->file('variant_files') as $index => $file) {
                if (! $file instanceof UploadedFile || ! $file->isValid()) {
                    continue;
                }

                $path = $file->store('products/variants', 'public');
                $label = trim((string) $request->input("variant_file_labels.{$index}", ''));

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => '/storage/'.$path,
                    'alt_text' => $label !== '' ? $label : $this->labelFromPath($file->getClientOriginalName()),
                    'sort_order' => $startOrder + $index + 1,
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

    private function syncPrimaryImage(Product $product): void
    {
        $product->refresh()->load('images');

        $first = $product->images->first();

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
