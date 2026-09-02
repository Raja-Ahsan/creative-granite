<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhere('slug', 'like', '%'.$search.'%');
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
        $item = new Material([
            'sort_order' => ((int) Material::query()->max('sort_order')) + 1,
            'is_featured' => false,
            'is_callout' => false,
            'is_active' => true,
        ]);
        $item->setRelation('images', collect());

        return view('screens.admin.materials.form', [
            'item' => $item,
            'title' => 'Add Material',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'materials');

        $material = Material::create($data);
        $this->syncGalleryImages($request, $material);

        return redirect()->route('admin.materials.index')->with('success', 'Material created.');
    }

    public function edit(Material $material): View
    {
        return view('screens.admin.materials.form', [
            'item' => $material->load('images'),
            'title' => 'Edit Material',
        ]);
    }

    public function update(Request $request, Material $material): RedirectResponse
    {
        $data = $this->validated($request, $material);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'materials');

        if (! $request->hasFile('image')) {
            $data['image_path'] = $material->image_path;
        }

        $material->update($data);
        $this->syncGalleryImages($request, $material);

        return redirect()->route('admin.materials.index')->with('success', 'Material updated.');
    }

    public function destroy(Material $material): RedirectResponse
    {
        foreach ($material->images as $image) {
            $this->deleteStoredImage($image->image_path);
        }

        $this->deleteStoredImage($material->image_path);
        $material->delete();

        return redirect()->route('admin.materials.index')->with('success', 'Material deleted.');
    }

    private function validated(Request $request, ?Material $material = null): array
    {
        $whyChoose = collect(preg_split('/\r\n|\r|\n/', (string) $request->input('why_choose_text', '')))
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values()
            ->all();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('materials', 'slug')->ignore($material?->id),
            ],
            'description' => ['required', 'string'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'why_choose_heading' => ['nullable', 'string', 'max:255'],
            'what_to_know' => ['nullable', 'string'],
            'best_for' => ['nullable', 'string'],
            'care_guide_url' => ['nullable', 'string', 'max:500'],
            'care_guide_label' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'cta_eyebrow' => ['nullable', 'string', 'max:120'],
            'cta_heading' => ['nullable', 'string', 'max:255'],
            'cta_body' => ['nullable', 'string'],
            'cta_primary_label' => ['nullable', 'string', 'max:120'],
            'cta_secondary_label' => ['nullable', 'string', 'max:120'],
            'cta_secondary_url' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:12288'],
            'existing_gallery' => ['nullable', 'array'],
            'existing_gallery.*.alt_text' => ['nullable', 'string', 'max:255'],
            'existing_gallery.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['integer', 'exists:material_images,id'],
            'gallery_new' => ['nullable', 'array'],
            'gallery_new.*.file' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:12288'],
            'gallery_new.*.alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_callout' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'why_choose' => $whyChoose,
            'slug' => $this->resolveSlug($request->input('slug'), $request->input('name'), $material),
            'is_featured' => $request->boolean('is_featured'),
            'is_callout' => $request->boolean('is_callout'),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => (int) $request->input('sort_order', 0),
        ];

        return $data;
    }

    private function resolveSlug(?string $slug, string $name, ?Material $material): string
    {
        $candidate = filled($slug) ? Str::slug($slug) : Str::slug($name);
        $original = $candidate;
        $counter = 1;

        while (
            Material::query()
                ->when($material, fn ($query) => $query->whereKeyNot($material->getKey()))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $original.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }

    private function syncGalleryImages(Request $request, Material $material): void
    {
        $removeIds = $request->input('remove_gallery', []);
        if (is_array($removeIds) && $removeIds !== []) {
            MaterialImage::query()
                ->where('material_id', $material->id)
                ->whereIn('id', $removeIds)
                ->get()
                ->each(function (MaterialImage $image) {
                    $this->deleteStoredImage($image->image_path);
                    $image->delete();
                });
        }

        $existing = $request->input('existing_gallery', []);
        if (is_array($existing)) {
            foreach ($existing as $id => $values) {
                $image = MaterialImage::query()
                    ->where('material_id', $material->id)
                    ->whereKey($id)
                    ->first();

                if (! $image) {
                    continue;
                }

                $image->update([
                    'alt_text' => $values['alt_text'] ?? $image->alt_text,
                    'sort_order' => (int) ($values['sort_order'] ?? $image->sort_order),
                ]);
            }
        }

        $startOrder = (int) $material->images()->max('sort_order');

        if ($request->has('gallery_new') && is_array($request->input('gallery_new'))) {
            foreach ($request->input('gallery_new') as $index => $row) {
                $file = $request->file("gallery_new.{$index}.file");
                if (! $file instanceof UploadedFile || ! $file->isValid()) {
                    continue;
                }

                $path = $file->store('materials/gallery', 'public');
                $alt = trim((string) ($row['alt_text'] ?? ''));

                MaterialImage::create([
                    'material_id' => $material->id,
                    'image_path' => '/storage/'.$path,
                    'alt_text' => $alt !== '' ? $alt : $material->name,
                    'sort_order' => ++$startOrder,
                ]);
            }
        }
    }
}
