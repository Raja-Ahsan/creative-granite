<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\ServicePageSection;
use App\Models\ServicePageSectionImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;

class ServicePageSectionController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('screens.admin.service-page-sections.index', [
            'items' => ServicePageSection::query()->withCount('images')->ordered()->get(),
            'title' => 'Services Page Sections',
        ]);
    }

    public function create(): View
    {
        $item = new ServicePageSection([
            'number_label' => str_pad((string) (ServicePageSection::query()->count() + 1), 2, '0', STR_PAD_LEFT),
            'sort_order' => ((int) ServicePageSection::query()->max('sort_order')) + 1,
            'is_active' => true,
        ]);
        $item->setRelation('images', collect());

        return view('screens.admin.service-page-sections.form', [
            'item' => $item,
            'title' => 'Add Services Page Section',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data, 'hero_path', 'public', 'services-page', 'hero');
        $section = ServicePageSection::create($data);
        $this->storeSupportingImages($request, $section);

        return redirect()->route('admin.service-page-sections.index')->with('success', 'Section created.');
    }

    public function edit(ServicePageSection $servicePageSection): View
    {
        return view('screens.admin.service-page-sections.form', [
            'item' => $servicePageSection->load('images'),
            'title' => 'Edit Services Page Section',
        ]);
    }

    public function update(Request $request, ServicePageSection $servicePageSection): RedirectResponse
    {
        $data = $this->validated($request, $servicePageSection);
        $data = $this->mergeImagePath($request, $data, 'hero_path', 'public', 'services-page', 'hero');
        $servicePageSection->update($data);
        $this->removeSupportingImages($request);
        $this->storeSupportingImages($request, $servicePageSection);

        return redirect()->route('admin.service-page-sections.index')->with('success', 'Section updated.');
    }

    public function destroy(ServicePageSection $servicePageSection): RedirectResponse
    {
        $this->deleteStoredImage($servicePageSection->hero_path);
        foreach ($servicePageSection->images as $image) {
            $this->deleteStoredImage($image->image_path);
        }
        $servicePageSection->delete();

        return redirect()->route('admin.service-page-sections.index')->with('success', 'Section deleted.');
    }

    private function validated(Request $request, ?ServicePageSection $item = null): array
    {
        $data = $request->validate([
            'number_label' => ['required', 'string', 'max:10'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string', 'max:5000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'hero' => [$item?->hero_path ? 'nullable' : 'required', 'image', 'max:12288'],
            'supporting_images' => ['nullable', 'array'],
            'supporting_images.*' => ['image', 'max:12288'],
            'remove_supporting_images' => ['nullable', 'array'],
            'remove_supporting_images.*' => ['integer', 'exists:service_page_section_images,id'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        unset($data['hero'], $data['supporting_images'], $data['remove_supporting_images']);

        return $data;
    }

    private function storeSupportingImages(Request $request, ServicePageSection $section): void
    {
        if (! $request->hasFile('supporting_images')) {
            return;
        }

        $start = (int) $section->images()->max('sort_order');
        foreach ($request->file('supporting_images') as $index => $file) {
            if (! $file instanceof UploadedFile || ! $file->isValid()) {
                continue;
            }
            $path = $file->store('services-page/supporting', 'public');
            ServicePageSectionImage::create([
                'service_page_section_id' => $section->id,
                'image_path' => '/storage/'.$path,
                'sort_order' => $start + $index + 1,
            ]);
        }
    }

    private function removeSupportingImages(Request $request): void
    {
        $ids = $request->input('remove_supporting_images', []);
        if (! is_array($ids) || $ids === []) {
            return;
        }

        $images = ServicePageSectionImage::query()->whereIn('id', $ids)->get();
        foreach ($images as $image) {
            $this->deleteStoredImage($image->image_path);
            $image->delete();
        }
    }
}
