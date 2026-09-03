<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\EdgeProfile;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EdgeProfileController extends Controller
{
    use HandlesImageUpload;

    private const SECTION_KEYS = [
        'edge_profiles_eyebrow',
        'edge_profiles_heading',
        'edge_profiles_body',
        'edge_profiles_note',
    ];

    public function index(): View
    {
        return view('screens.admin.edge-profiles.index', [
            'items' => EdgeProfile::query()->orderBy('sort_order')->orderBy('id')->get(),
            'sectionValues' => $this->sectionValues(),
            'title' => 'Edge Profiles',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.edge-profiles.form', [
            'item' => new EdgeProfile([
                'sort_order' => ((int) EdgeProfile::query()->max('sort_order')) + 1,
                'is_active' => true,
            ]),
            'title' => 'Add Edge Profile',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        EdgeProfile::create($this->validated($request));

        return redirect()->route('admin.edge-profiles.index')->with('success', 'Edge profile created.');
    }

    public function edit(EdgeProfile $edgeProfile): View
    {
        return view('screens.admin.edge-profiles.form', [
            'item' => $edgeProfile,
            'title' => 'Edit Edge Profile',
        ]);
    }

    public function update(Request $request, EdgeProfile $edgeProfile): RedirectResponse
    {
        $edgeProfile->update($this->validated($request, $edgeProfile));

        return redirect()->route('admin.edge-profiles.index')->with('success', 'Edge profile updated.');
    }

    public function destroy(EdgeProfile $edgeProfile): RedirectResponse
    {
        $this->deleteStoredImage($edgeProfile->image_path);
        $this->deleteStoredImage($edgeProfile->diagram_path);
        $edgeProfile->delete();

        return redirect()->route('admin.edge-profiles.index')->with('success', 'Edge profile deleted.');
    }

    public function updateSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'edge_profiles_eyebrow' => ['nullable', 'string', 'max:120'],
            'edge_profiles_heading' => ['nullable', 'string', 'max:255'],
            'edge_profiles_body' => ['nullable', 'string', 'max:5000'],
            'edge_profiles_note' => ['nullable', 'string', 'max:5000'],
        ]);

        foreach (self::SECTION_KEYS as $key) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => (string) ($data[$key] ?? ''), 'type' => 'string', 'group' => 'edge_profiles']
            );
        }

        return redirect()->route('admin.edge-profiles.index')->with('success', 'Edge profiles section updated.');
    }

    private function validated(Request $request, ?EdgeProfile $edgeProfile = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('edge_profiles', 'slug')->ignore($edgeProfile?->id),
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:12288'],
            'diagram' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:12288'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'remove_diagram' => ['nullable', 'boolean'],
        ]);

        unset($data['image'], $data['diagram'], $data['remove_diagram']);

        $data['slug'] = $this->resolveSlug($request->input('slug'), $request->string('name')->toString(), $edgeProfile);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) $request->input('sort_order', 0);
        $data['image_path'] = $edgeProfile?->image_path;
        $data['diagram_path'] = $edgeProfile?->diagram_path;

        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'edges', 'image');

        if ($request->boolean('remove_diagram') && ! $request->hasFile('diagram')) {
            $this->deleteStoredImage($edgeProfile?->diagram_path);
            $data['diagram_path'] = null;
        } else {
            $data = $this->mergeImagePath($request, $data, 'diagram_path', 'public', 'edges/diagrams', 'diagram');
        }

        if ($request->hasFile('image') && $edgeProfile?->image_path) {
            $this->deleteStoredImage($edgeProfile->image_path);
        }

        if ($request->hasFile('diagram') && $edgeProfile?->diagram_path) {
            $this->deleteStoredImage($edgeProfile->diagram_path);
        }

        return $data;
    }

    private function resolveSlug(?string $slug, string $name, ?EdgeProfile $edgeProfile): string
    {
        $candidate = filled($slug) ? Str::slug($slug) : Str::slug($name);
        $original = $candidate;
        $counter = 1;

        while (
            EdgeProfile::query()
                ->when($edgeProfile, fn ($query) => $query->whereKeyNot($edgeProfile->getKey()))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $original.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }

    private function sectionValues(): array
    {
        $defaults = [
            'edge_profiles_eyebrow' => '',
            'edge_profiles_heading' => 'Edge Profiles',
            'edge_profiles_body' => 'The edge profile is a finishing detail that can subtly—or dramatically—change the look of a surface. Explore some of our most commonly requested profiles below. Our fabrication capabilities also allow us to create custom edge details tailored to the material, application, and design of your project.',
            'edge_profiles_note' => 'The edge profiles shown here represent some of our most commonly requested options and are intended as examples of what we can create. They are not a complete representation of our fabrication capabilities. We offer a variety of additional edge profiles and can work with you to create a custom profile to suit your specific design and project needs.',
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SECTION_KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }
}
