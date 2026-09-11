<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Remnant;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RemnantController extends Controller
{
    use HandlesImageUpload;

    private const SECTION_KEYS = [
        'remnants_cta_heading',
        'remnants_cta_body',
        'remnants_cta_button_label',
        'remnants_cta_button_url',
        'remnants_page_heading',
        'remnants_page_subheading',
        'remnants_coming_soon_heading',
        'remnants_coming_soon_body',
    ];

    public function index(): View
    {
        return view('screens.admin.remnants.index', [
            'items' => Remnant::query()->orderBy('sort_order')->orderBy('id')->get(),
            'sectionValues' => $this->sectionValues(),
            'title' => 'Remnants',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.remnants.form', [
            'item' => new Remnant([
                'sort_order' => ((int) Remnant::query()->max('sort_order')) + 1,
                'is_active' => true,
                'is_available' => true,
                'availability_status' => 'available',
            ]),
            'title' => 'Add Remnant',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Remnant::create($this->validated($request));

        return redirect()->route('admin.remnants.index')->with('success', 'Remnant created.');
    }

    public function edit(Remnant $remnant): View
    {
        return view('screens.admin.remnants.form', [
            'item' => $remnant,
            'title' => 'Edit Remnant',
        ]);
    }

    public function update(Request $request, Remnant $remnant): RedirectResponse
    {
        $remnant->update($this->validated($request, $remnant));

        return redirect()->route('admin.remnants.index')->with('success', 'Remnant updated.');
    }

    public function destroy(Remnant $remnant): RedirectResponse
    {
        $this->deleteStoredImage($remnant->image_path);
        $remnant->delete();

        return redirect()->route('admin.remnants.index')->with('success', 'Remnant removed.');
    }

    public function updateSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'remnants_cta_heading' => ['nullable', 'string', 'max:255'],
            'remnants_cta_body' => ['nullable', 'string', 'max:5000'],
            'remnants_cta_button_label' => ['nullable', 'string', 'max:120'],
            'remnants_cta_button_url' => ['nullable', 'string', 'max:500'],
            'remnants_page_heading' => ['nullable', 'string', 'max:255'],
            'remnants_page_subheading' => ['nullable', 'string', 'max:5000'],
            'remnants_coming_soon_heading' => ['nullable', 'string', 'max:255'],
            'remnants_coming_soon_body' => ['nullable', 'string', 'max:5000'],
        ]);

        foreach (self::SECTION_KEYS as $key) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => (string) ($data[$key] ?? ''),
                    'type' => 'string',
                    'group' => 'remnants',
                ]
            );
        }

        return redirect()->route('admin.remnants.index')->with('success', 'Remnants page content updated.');
    }

    private function validated(Request $request, ?Remnant $remnant = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('remnants', 'slug')->ignore($remnant?->id),
            ],
            'material' => ['nullable', 'string', 'max:255'],
            'finish' => ['nullable', 'string', 'max:255'],
            'dimensions' => ['nullable', 'string', 'max:255'],
            'thickness' => ['nullable', 'string', 'max:120'],
            'remnant_code' => ['nullable', 'string', 'max:120'],
            'quantity' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'suitability' => ['nullable', 'string', 'max:500'],
            'price_label' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:12288'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'availability_status' => ['required', 'in:available,coming_soon'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        unset($data['image'], $data['remove_image']);

        $data['slug'] = $this->resolveSlug($request->input('slug'), $request->string('name')->toString(), $remnant);
        $data['is_active'] = $request->boolean('is_active');
        $data['availability_status'] = $request->input('availability_status', 'available');
        $data['is_available'] = $data['availability_status'] === 'available';
        $data['sort_order'] = (int) $request->input('sort_order', 0);
        $data['quantity'] = $request->filled('quantity') ? (int) $request->input('quantity') : null;
        $data['image_path'] = $remnant?->image_path;

        if ($request->boolean('remove_image') && ! $request->hasFile('image')) {
            $this->deleteStoredImage($remnant?->image_path);
            $data['image_path'] = null;
        } else {
            $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'remnants', 'image');
            if ($request->hasFile('image') && $remnant?->image_path) {
                $this->deleteStoredImage($remnant->image_path);
            }
        }

        return $data;
    }

    private function resolveSlug(?string $slug, string $name, ?Remnant $remnant): string
    {
        $candidate = filled($slug) ? Str::slug($slug) : Str::slug($name);
        $original = $candidate;
        $counter = 1;

        while (
            Remnant::query()
                ->when($remnant, fn ($query) => $query->whereKeyNot($remnant->getKey()))
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
            'remnants_cta_heading' => 'Explore Available Remnants',
            'remnants_cta_body' => 'Looking for a beautiful stone for a smaller project? Explore our available remnants and find the perfect piece for your project.',
            'remnants_cta_button_label' => 'Explore Remnants',
            'remnants_cta_button_url' => '/remnants',
            'remnants_page_heading' => 'Available Remnants',
            'remnants_page_subheading' => 'Explore our selection of available stone remnants for smaller projects and custom applications.',
            'remnants_coming_soon_heading' => 'Available Remnants — Coming Soon',
            'remnants_coming_soon_body' => "We're currently organizing our remnant inventory and photography. Please check back soon to explore available pieces.",
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SECTION_KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }
}
