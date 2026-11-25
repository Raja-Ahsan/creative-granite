<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    use HandlesImageUpload;

    private const SECTION_KEYS = [
        'hero_intro_eyebrow',
        'hero_intro_heading',
        'hero_intro_subheading',
        'hero_intro_button_label',
        'hero_intro_button_url',
    ];

    public function index(): View
    {
        return view('screens.admin.hero-slides.index', [
            'items' => HeroSlide::query()->orderBy('sort_order')->get(),
            'sectionValues' => $this->sectionValues(),
            'title' => 'Hero Banner',
        ]);
    }

    public function updateSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'hero_intro_eyebrow' => ['nullable', 'string', 'max:120'],
            'hero_intro_heading' => ['nullable', 'string', 'max:300'],
            'hero_intro_subheading' => ['nullable', 'string', 'max:500'],
            'hero_intro_button_label' => ['nullable', 'string', 'max:120'],
            'hero_intro_button_url' => ['nullable', 'string', 'max:500'],
        ]);

        foreach (self::SECTION_KEYS as $key) {
            $this->saveSetting($key, $data[$key] ?? '');
        }

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Hero banner text updated.');
    }

    private function sectionValues(): array
    {
        $defaults = [
            'hero_intro_eyebrow' => 'Welcome to creative granite and design',
            'hero_intro_heading' => "Countertop Installation Salt Lake City, UT —\nCustom Stone for Inspired Spaces",
            'hero_intro_subheading' => 'Serving homeowners, builders, and multifamily projects across Utah',
            'hero_intro_button_label' => 'Get an Estimate',
            'hero_intro_button_url' => '#estimate',
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SECTION_KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }

    private function saveSetting(string $key, string $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => 'string', 'group' => 'hero']
        );
    }

    public function create(): View
    {
        return view('screens.admin.hero-slides.form', [
            'item' => new HeroSlide(),
            'title' => 'Add Hero Slide',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data);
        $data['alt_text'] = $this->altTextFromUpload($request);

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created.');
    }

    public function edit(HeroSlide $heroSlide): View
    {
        return view('screens.admin.hero-slides.form', [
            'item' => $heroSlide,
            'title' => 'Edit Hero Slide',
        ]);
    }

    public function update(Request $request, HeroSlide $heroSlide): RedirectResponse
    {
        $data = $this->validated($request, $heroSlide);
        $data = $this->mergeImagePath($request, $data);

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($heroSlide->image_path);
            $data['alt_text'] = $this->altTextFromUpload($request);
        }

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated.');
    }

    public function destroy(HeroSlide $heroSlide): RedirectResponse
    {
        $this->deleteStoredImage($heroSlide->image_path);
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide deleted.');
    }

    private function validated(Request $request, ?HeroSlide $heroSlide = null): array
    {
        return $request->validate([
            'image' => [$heroSlide?->image_path ? 'nullable' : 'required', 'image', 'max:10240'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', 0),
        ];
    }

    private function altTextFromUpload(Request $request): string
    {
        $filename = $request->file('image')?->getClientOriginalName() ?? 'hero-slide';

        return str(pathinfo($filename, PATHINFO_FILENAME))
            ->replace(['-', '_'], ' ')
            ->title()
            ->toString();
    }
}
