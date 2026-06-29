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

    public function index(): View
    {
        return view('screens.admin.materials.index', [
            'items' => Material::query()->orderBy('sort_order')->get(),
            'title' => 'Materials',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.materials.form', ['item' => new Material(), 'title' => 'Add Material']);
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
        return view('screens.admin.materials.form', ['item' => $material, 'title' => 'Edit Material']);
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
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', 0),
        ];
    }
}
