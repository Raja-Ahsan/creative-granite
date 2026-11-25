<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\ServiceGuide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceGuideController extends Controller
{
    use HandlesImageUpload;

    protected bool $isServiceArea = false;

    protected string $routeName = 'admin.service-guides';

    protected string $indexTitle = 'Service Guides';

    protected string $createTitle = 'Add Service Guide';

    protected string $editTitle = 'Edit Service Guide';

    protected string $createdMessage = 'Service guide created.';

    protected string $updatedMessage = 'Service guide updated.';

    protected string $deletedMessage = 'Service guide deleted.';

    protected string $emptyMessage = 'No service guide pages yet.';

    protected string $addButtonLabel = 'Add Guide Page';

    protected string $deleteConfirm = 'Delete this service guide page?';

    public function index(): View
    {
        return view('screens.admin.service-guides.index', [
            'items' => $this->guideQuery()->orderBy('sort_order')->orderBy('id')->get(),
            'title' => $this->indexTitle,
            'routeName' => $this->routeName,
            'addButtonLabel' => $this->addButtonLabel,
            'emptyMessage' => $this->emptyMessage,
            'deleteConfirm' => $this->deleteConfirm,
            'isServiceArea' => $this->isServiceArea,
        ]);
    }

    public function create(): View
    {
        return $this->formView(new ServiceGuide([
            'is_active' => true,
            'show_in_nav' => ! $this->isServiceArea,
            'is_service_area' => $this->isServiceArea,
            'sort_order' => 0,
        ]), $this->createTitle);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title']);
        $data['is_service_area'] = $this->isServiceArea;
        if ($this->isServiceArea) {
            $data['show_in_nav'] = false;
        }
        $data = $this->applyGuideImages($request, $data);

        $guide = ServiceGuide::create($data);
        $this->syncChildren($guide, $request);

        return redirect()
            ->route($this->routeName.'.edit', $guide)
            ->with('success', $this->createdMessage);
    }

    public function edit(ServiceGuide $serviceGuide): View
    {
        $this->ensureGuideType($serviceGuide);
        $serviceGuide->load(['materials', 'steps', 'faqs', 'buttons']);

        return $this->formView($serviceGuide, $this->editTitle);
    }

    public function update(Request $request, ServiceGuide $serviceGuide): RedirectResponse
    {
        $this->ensureGuideType($serviceGuide);

        $data = $this->validated($request, $serviceGuide);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title'], $serviceGuide);
        $data['is_service_area'] = $this->isServiceArea;
        if ($this->isServiceArea) {
            $data['show_in_nav'] = false;
        }
        $data = $this->applyGuideImages($request, $data, $serviceGuide);

        $serviceGuide->update($data);
        $this->syncChildren($serviceGuide, $request);

        return redirect()
            ->route($this->routeName.'.edit', $serviceGuide)
            ->with('success', $this->updatedMessage);
    }

    public function destroy(ServiceGuide $serviceGuide): RedirectResponse
    {
        $this->ensureGuideType($serviceGuide);

        foreach ([
            $serviceGuide->hero_image_path,
            $serviceGuide->process_image_path,
            $serviceGuide->work_image_path,
            $serviceGuide->additional_image_path,
            $serviceGuide->advantages_image_path,
        ] as $path) {
            $this->deleteStoredImage($path);
        }

        foreach ($serviceGuide->materials as $material) {
            $this->deleteStoredImage($material->image_path);
        }

        $serviceGuide->delete();

        return redirect()
            ->route($this->routeName.'.index')
            ->with('success', $this->deletedMessage);
    }

    protected function guideQuery()
    {
        return ServiceGuide::query()->where('is_service_area', $this->isServiceArea);
    }

    protected function ensureGuideType(ServiceGuide $guide): void
    {
        if ((bool) $guide->is_service_area !== $this->isServiceArea) {
            abort(404);
        }
    }

    protected function formView(ServiceGuide $item, string $title): View
    {
        $buttons = $item->exists ? $item->buttons : collect();

        return view('screens.admin.service-guides.form', [
            'item' => $item,
            'materials' => $item->exists ? $item->materials : collect(),
            'steps' => $item->exists ? $item->steps : collect(),
            'faqs' => $item->exists ? $item->faqs : collect(),
            'heroButtons' => $buttons->where('section', 'hero_cta')->values(),
            'processButtons' => $buttons->where('section', 'process_cta')->values(),
            'workButtons' => $buttons->where('section', 'work_cta')->values(),
            'materialsButtons' => $buttons->where('section', 'materials_cta')->values(),
            'advantagesButtons' => $buttons->where('section', 'advantages_cta')->values(),
            'closingButtons' => $buttons->where('section', 'closing_cta')->values(),
            'title' => $title,
            'routeName' => $this->routeName,
            'isServiceArea' => $this->isServiceArea,
        ]);
    }

    private function applyGuideImages(Request $request, array $data, ?ServiceGuide $guide = null): array
    {
        foreach ([
            'hero_image' => 'hero_image_path',
            'process_image' => 'process_image_path',
            'work_image' => 'work_image_path',
            'additional_image' => 'additional_image_path',
            'advantages_image' => 'advantages_image_path',
        ] as $fileInput => $field) {
            if ($request->boolean('remove_'.$fileInput)) {
                $this->deleteStoredImage($guide?->{$field});
                $data[$field] = null;
            } elseif ($request->hasFile($fileInput)) {
                $this->deleteStoredImage($guide?->{$field});
                $path = $request->file($fileInput)->store('service-guides', 'public');
                $data[$field] = '/storage/'.$path;
            } else {
                unset($data[$field]);
            }
        }

        return $data;
    }

    private function validated(Request $request, ?ServiceGuide $guide = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('service_guides', 'slug')->ignore($guide?->id),
            ],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'hero_body' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'max:10240'],
            'process_eyebrow' => ['nullable', 'string', 'max:120'],
            'process_heading' => ['nullable', 'string', 'max:255'],
            'process_body' => ['nullable', 'string'],
            'process_image' => ['nullable', 'image', 'max:10240'],
            'work_eyebrow' => ['nullable', 'string', 'max:120'],
            'work_heading' => ['nullable', 'string', 'max:255'],
            'work_body' => ['nullable', 'string'],
            'work_image' => ['nullable', 'image', 'max:10240'],
            'additional_image' => ['nullable', 'image', 'max:10240'],
            'advantages_image' => ['nullable', 'image', 'max:10240'],
            'remove_hero_image' => ['sometimes', 'boolean'],
            'remove_process_image' => ['sometimes', 'boolean'],
            'remove_work_image' => ['sometimes', 'boolean'],
            'remove_additional_image' => ['sometimes', 'boolean'],
            'remove_advantages_image' => ['sometimes', 'boolean'],
            'materials_eyebrow' => ['nullable', 'string', 'max:120'],
            'materials_heading' => ['nullable', 'string', 'max:255'],
            'materials_intro' => ['nullable', 'string'],
            'additional_eyebrow' => ['nullable', 'string', 'max:120'],
            'additional_heading' => ['nullable', 'string', 'max:255'],
            'additional_body' => ['nullable', 'string'],
            'additional_help_text' => ['nullable', 'string'],
            'advantages_heading' => ['nullable', 'string', 'max:255'],
            'advantages_body' => ['nullable', 'string'],
            'faq_heading' => ['nullable', 'string', 'max:255'],
            'cta_heading' => ['nullable', 'string', 'max:255'],
            'cta_body' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'show_in_nav' => ['nullable', 'boolean'],
            'materials' => ['nullable', 'array'],
            'materials.*.name' => ['nullable', 'string', 'max:255'],
            'materials.*.body' => ['nullable', 'string'],
            'materials.*.image_path' => ['nullable', 'string', 'max:500'],
            'materials.*.image' => ['nullable', 'image', 'max:10240'],
            'materials.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'materials.*.is_active' => ['nullable', 'boolean'],
            'steps' => ['nullable', 'array'],
            'steps.*.step_number' => ['nullable', 'string', 'max:10'],
            'steps.*.title' => ['nullable', 'string', 'max:255'],
            'steps.*.body' => ['nullable', 'string'],
            'steps.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'steps.*.is_active' => ['nullable', 'boolean'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['nullable', 'string', 'max:255'],
            'faqs.*.answer' => ['nullable', 'string'],
            'faqs.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'faqs.*.is_active' => ['nullable', 'boolean'],
            'hero_buttons' => ['nullable', 'array'],
            'hero_buttons.*.label' => ['nullable', 'string', 'max:255'],
            'hero_buttons.*.url' => ['nullable', 'string', 'max:500'],
            'hero_buttons.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'hero_buttons.*.is_active' => ['nullable', 'boolean'],
            'process_buttons' => ['nullable', 'array'],
            'process_buttons.*.label' => ['nullable', 'string', 'max:255'],
            'process_buttons.*.url' => ['nullable', 'string', 'max:500'],
            'process_buttons.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'process_buttons.*.is_active' => ['nullable', 'boolean'],
            'work_buttons' => ['nullable', 'array'],
            'work_buttons.*.label' => ['nullable', 'string', 'max:255'],
            'work_buttons.*.url' => ['nullable', 'string', 'max:500'],
            'work_buttons.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'work_buttons.*.is_active' => ['nullable', 'boolean'],
            'materials_buttons' => ['nullable', 'array'],
            'materials_buttons.*.label' => ['nullable', 'string', 'max:255'],
            'materials_buttons.*.url' => ['nullable', 'string', 'max:500'],
            'materials_buttons.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'materials_buttons.*.is_active' => ['nullable', 'boolean'],
            'advantages_buttons' => ['nullable', 'array'],
            'advantages_buttons.*.label' => ['nullable', 'string', 'max:255'],
            'advantages_buttons.*.url' => ['nullable', 'string', 'max:500'],
            'advantages_buttons.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'advantages_buttons.*.is_active' => ['nullable', 'boolean'],
            'closing_buttons' => ['nullable', 'array'],
            'closing_buttons.*.label' => ['nullable', 'string', 'max:255'],
            'closing_buttons.*.url' => ['nullable', 'string', 'max:500'],
            'closing_buttons.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'closing_buttons.*.is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'show_in_nav' => $this->isServiceArea ? false : $request->boolean('show_in_nav'),
            'sort_order' => (int) $request->input('sort_order', 0),
        ];
    }

    private function syncChildren(ServiceGuide $guide, Request $request): void
    {
        $previousImages = $guide->materials()->pluck('image_path')->filter()->all();
        $keptImages = [];

        $guide->materials()->delete();
        foreach ($request->input('materials', []) as $index => $row) {
            if (! filled($row['name'] ?? null) && ! filled($row['body'] ?? null)) {
                continue;
            }

            $imagePath = $row['image_path'] ?? null;
            if ($request->hasFile("materials.$index.image")) {
                $this->deleteStoredImage($imagePath);
                $stored = $request->file("materials.$index.image")->store('service-guides/materials', 'public');
                $imagePath = '/storage/'.$stored;
            }

            if ($imagePath) {
                $keptImages[] = $imagePath;
            }

            $guide->materials()->create([
                'name' => $row['name'] ?? '',
                'body' => $row['body'] ?? '',
                'image_path' => $imagePath,
                'sort_order' => (int) ($row['sort_order'] ?? $index),
                'is_active' => ! empty($row['is_active']),
            ]);
        }

        foreach ($previousImages as $oldPath) {
            if (! in_array($oldPath, $keptImages, true)) {
                $this->deleteStoredImage($oldPath);
            }
        }

        $guide->steps()->delete();
        foreach ($request->input('steps', []) as $index => $row) {
            if (! filled($row['title'] ?? null) && ! filled($row['body'] ?? null)) {
                continue;
            }

            $guide->steps()->create([
                'step_number' => $row['step_number'] ?? '',
                'title' => $row['title'] ?? '',
                'body' => $row['body'] ?? '',
                'sort_order' => (int) ($row['sort_order'] ?? $index),
                'is_active' => ! empty($row['is_active']),
            ]);
        }

        $guide->faqs()->delete();
        foreach ($request->input('faqs', []) as $index => $row) {
            if (! filled($row['question'] ?? null) && ! filled($row['answer'] ?? null)) {
                continue;
            }

            $guide->faqs()->create([
                'question' => $row['question'] ?? '',
                'answer' => $row['answer'] ?? '',
                'sort_order' => (int) ($row['sort_order'] ?? $index),
                'is_active' => ! empty($row['is_active']),
            ]);
        }

        $guide->buttons()->delete();
        foreach ([
            'hero_buttons' => 'hero_cta',
            'process_buttons' => 'process_cta',
            'work_buttons' => 'work_cta',
            'materials_buttons' => 'materials_cta',
            'advantages_buttons' => 'advantages_cta',
            'closing_buttons' => 'closing_cta',
        ] as $inputKey => $section) {
            foreach ($request->input($inputKey, []) as $index => $row) {
                if (! filled($row['label'] ?? null) && ! filled($row['url'] ?? null)) {
                    continue;
                }

                $guide->buttons()->create([
                    'section' => $section,
                    'label' => $row['label'] ?? '',
                    'url' => $row['url'] ?? '',
                    'sort_order' => (int) ($row['sort_order'] ?? $index),
                    'is_active' => ! empty($row['is_active']),
                ]);
            }
        }
    }

    private function resolveSlug(?string $slug, string $title, ?ServiceGuide $guide = null): string
    {
        $candidate = filled($slug) ? Str::slug($slug) : Str::slug($title);
        if ($candidate === '') {
            $candidate = 'service-guide';
        }

        $base = $candidate;
        $i = 2;
        while (
            ServiceGuide::query()
                ->when($guide, fn ($q) => $q->where('id', '!=', $guide->id))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $base.'-'.$i;
            $i++;
        }

        return $candidate;
    }
}
