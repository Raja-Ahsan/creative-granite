<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $active = $request->string('active')->toString();
        $sort = $request->string('sort')->toString() ?: 'sort_order';
        $direction = strtolower($request->string('direction')->toString()) === 'desc' ? 'desc' : 'asc';

        $allowedSorts = ['sort_order', 'name', 'short_name', 'slug', 'created_at', 'id'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'sort_order';
        }

        $query = ProductCategory::query()->withCount('products');

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', '%'.$search.'%')
                    ->orWhere('short_name', 'like', '%'.$search.'%')
                    ->orWhere('slug', 'like', '%'.$search.'%');
            });
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

        return view('screens.admin.product-categories.index', [
            'items' => $query->paginate(12)->withQueryString(),
            'title' => 'Product Categories',
            'filters' => [
                'search' => $search,
                'active' => $active,
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.product-categories.form', [
            'item' => new ProductCategory([
                'sort_order' => ((int) ProductCategory::query()->max('sort_order')) + 1,
                'is_active' => true,
            ]),
            'title' => 'Add Category',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['name']);

        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Category created.');
    }

    public function edit(ProductCategory $productCategory): View
    {
        return view('screens.admin.product-categories.form', [
            'item' => $productCategory,
            'title' => 'Edit Category',
        ]);
    }

    public function update(Request $request, ProductCategory $productCategory): RedirectResponse
    {
        $data = $this->validated($request, $productCategory);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['name'], $productCategory);

        $productCategory->update($data);

        if ($productCategory->wasChanged('name')) {
            $productCategory->products()->update(['material' => $productCategory->name]);
        }

        return redirect()->route('admin.product-categories.index')->with('success', 'Category updated.');
    }

    public function destroy(ProductCategory $productCategory): RedirectResponse
    {
        if ($productCategory->products()->exists()) {
            return redirect()
                ->route('admin.product-categories.index')
                ->with('error', 'Cannot delete a category that still has products assigned. Reassign or remove those products first.');
        }

        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('success', 'Category deleted.');
    }

    private function validated(Request $request, ?ProductCategory $category = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_name' => ['nullable', 'string', 'max:120'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('product_categories', 'slug')->ignore($category?->id),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => (int) $request->input('sort_order', 0),
            'short_name' => filled($request->input('short_name')) ? $request->input('short_name') : null,
        ];
    }

    private function resolveSlug(?string $slug, string $source, ?ProductCategory $category = null): string
    {
        $candidate = filled($slug) ? Str::slug($slug) : Str::slug($source);
        $original = $candidate;
        $counter = 1;

        while (
            ProductCategory::query()
                ->when($category, fn ($query) => $query->whereKeyNot($category->getKey()))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $original.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }
}
