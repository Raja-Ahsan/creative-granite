<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('screens.admin.services.index', [
            'items' => Service::query()->orderBy('sort_order')->get(),
            'title' => 'Services',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.services.form', ['item' => new Service(), 'title' => 'Add Service']);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data, 'main_image_path', 'public', 'services', 'main_image');
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title']);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('screens.admin.services.form', ['item' => $service, 'title' => 'Edit Service']);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $this->validated($request, $service);
        $data = $this->mergeImagePath($request, $data, 'main_image_path', 'public', 'services', 'main_image');

        if ($request->hasFile('main_image')) {
            $this->deleteStoredImage($service->main_image_path);
        }

        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title'], $service);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->deleteStoredImage($service->main_image_path);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    private function validated(Request $request, ?Service $service = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('services', 'slug')->ignore($service?->id),
            ],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'main_image_path' => ['nullable', 'string', 'max:500'],
            'main_image' => ['nullable', 'image', 'max:10240'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', 0),
        ];
    }

    private function resolveSlug(?string $slug, string $title, ?Service $service = null): string
    {
        $candidate = filled($slug) ? Str::slug($slug) : Str::slug($title);

        if ($candidate === '') {
            $candidate = 'service';
        }

        $original = $candidate;
        $counter = 1;

        while (
            Service::query()
                ->when($service, fn ($query) => $query->whereKeyNot($service->getKey()))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $original.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }
}
