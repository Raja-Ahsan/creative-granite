<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterialController extends Controller
{
    use HandlesImageUpload;

    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $featured = $request->string('featured')->toString();
        $sort = $request->string('sort')->toString() ?: 'sort_order';
        $direction = strtolower($request->string('direction')->toString()) === 'desc' ? 'desc' : 'asc';

        $allowedSorts = ['sort_order', 'name', 'is_featured', 'created_at', 'id'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'sort_order';
        }

        $query = Material::query();

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
        }

        if ($featured === '1') {
            $query->where('is_featured', true);
        } elseif ($featured === '0') {
            $query->where('is_featured', false);
        }

        if ($sort === 'sort_order') {
            $query->orderBy('sort_order', $direction)->orderBy('id', $direction);
        } else {
            $query->orderBy($sort, $direction)->orderBy('sort_order')->orderBy('id');
        }

        return view('screens.admin.materials.index', [
            'items' => $query->paginate(12)->withQueryString(),
            'title' => 'Materials',
            'filters' => [
                'search' => $search,
                'featured' => $featured,
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.materials.form', [
            'item' => new Material([
                'sort_order' => ((int) Material::query()->max('sort_order')) + 1,
                'is_featured' => false,
                'is_active' => true,
            ]),
            'title' => 'Add Material',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data);
        Material::create($data);

        return redirect()->route('admin.materials.index')->with('success', 'Material created.');
    }

    public function edit(Material $material): View
    {
        return view('screens.admin.materials.form', [
            'item' => $material,
            'title' => 'Edit Material',
        ]);
    }

    public function update(Request $request, Material $material): RedirectResponse
    {
        $data = $this->validated($request, $material);
        $data = $this->mergeImagePath($request, $data);
        $material->update($data);

        return redirect()->route('admin.materials.index')->with('success', 'Material updated.');
    }

    public function destroy(Material $material): RedirectResponse
    {
        $material->delete();

        return redirect()->route('admin.materials.index')->with('success', 'Material deleted.');
    }

    private function validated(Request $request, ?Material $material = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image_path' => [$material ? 'nullable' : 'required_without:image', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'max:10240'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => (int) $request->input('sort_order', 0),
        ];
    }
}
