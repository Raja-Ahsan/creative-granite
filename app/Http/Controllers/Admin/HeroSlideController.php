<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('screens.admin.hero-slides.index', [
            'items' => HeroSlide::query()->orderBy('sort_order')->get(),
            'title' => 'Hero Slides',
        ]);
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
