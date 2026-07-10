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

    public function index(): View
    {
        return view('screens.admin.products.index', [
            'items' => Product::query()->orderBy('sort_order')->get(),
            'title' => 'Products',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.products.form', ['item' => new Product(), 'title' => 'Add Product']);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'products');
        $product = Product::create($data);

        $this->storeRelatedImages($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product): View
    {
        return view('screens.admin.products.form', [
            'item' => $product->load('images'),
            'title' => 'Edit Product',
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validated($request, $product);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'products');
        $product->update($data);

        $this->removeRelatedImages($request);
        $this->storeRelatedImages($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteStoredImage($product->image_path);

        foreach ($product->images()->get() as $image) {
            $this->deleteStoredImage($image->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'image_path' => [$product ? 'nullable' : 'required_without:image', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'max:10240'],
            'related_images' => ['nullable', 'array'],
            'related_images.*' => ['image', 'max:10240'],
            'remove_related_images' => ['nullable', 'array'],
            'remove_related_images.*' => ['integer', 'exists:product_images,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', 0),
        ];
    }

    private function storeRelatedImages(Request $request, Product $product): void
    {
        if (! $request->hasFile('related_images')) {
            return;
        }

        $startOrder = (int) $product->images()->max('sort_order');

        foreach ($request->file('related_images') as $index => $file) {
            if (! $file instanceof UploadedFile || ! $file->isValid()) {
                continue;
            }

            $path = $file->store('products/related', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => '/storage/'.$path,
                'sort_order' => $startOrder + $index + 1,
            ]);
        }
    }

    private function removeRelatedImages(Request $request): void
    {
        $ids = $request->input('remove_related_images', []);

        if (empty($ids)) {
            return;
        }

        ProductImage::query()
            ->whereIn('id', $ids)
            ->get()
            ->each(function (ProductImage $image) {
                $this->deleteStoredImage($image->image_path);
                $image->delete();
            });
    }
}
