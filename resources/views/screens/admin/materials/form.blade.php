@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.materials.update', $item) : route('admin.materials.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <div class="space-y-4">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Basics</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        <x-admin.input label="Name" name="name" :value="$item->name" required />
                        <x-admin.input label="URL Slug" name="slug" :value="$item->slug" placeholder="Auto-generated from name if left blank" />
                    </div>
                    <x-admin.input label="Tagline" name="tagline" :value="$item->tagline" placeholder="Natural beauty with centuries of history" />
                    <x-admin.textarea label="Card Description" name="description" :value="$item->description" required />
                    <x-admin.textarea label="Detail Intro" name="intro" :value="$item->intro" :rows="4" />
                </div>

                <div class="space-y-4 border-t border-gray-100 pt-8">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Why Choose</h3>
                    <x-admin.input
                        label="Section Heading"
                        name="why_choose_heading"
                        :value="$item->why_choose_heading"
                        placeholder="Leave blank to use “Why choose {material name}”"
                    />
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bullet Points (one per line)</label>
                        <textarea
                            name="why_choose_text"
                            rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('why_choose_text', collect($item->why_choose ?? [])->implode("\n")) }}</textarea>
                    </div>
                </div>

                <div class="space-y-4 border-t border-gray-100 pt-8">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Detail Content</h3>
                    <x-admin.textarea label="What to Know" name="what_to_know" :value="$item->what_to_know" :rows="4" />
                    <x-admin.textarea label="Best For" name="best_for" :value="$item->best_for" :rows="3" />
                    <div class="grid gap-4 md:grid-cols-2">
                        <x-admin.input label="Care Guide Label" name="care_guide_label" :value="$item->care_guide_label" placeholder="Natural Stone Care + Cleaning Guide" />
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Care Guide File</label>
                            <p class="mt-1 text-xs text-gray-500">Upload a PDF. This replaces the previous file.</p>
                            @if ($item->care_guide_url)
                                <div class="mt-2 mb-2 flex flex-wrap items-center gap-3 text-sm">
                                    <a href="{{ $item->care_guide_url }}" target="_blank" rel="noopener noreferrer" class="text-indigo-600 underline">
                                        View current file
                                    </a>
                                    <label class="inline-flex items-center gap-2 text-xs font-medium text-red-600">
                                        <input type="checkbox" name="remove_care_guide" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                        Remove
                                    </label>
                                </div>
                            @endif
                            <input
                                type="file"
                                name="care_guide"
                                accept=".pdf,application/pdf"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700 hover:file:bg-gray-200"
                            >
                            @error('care_guide')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-4 border-t border-gray-100 pt-8">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Bottom CTA (detail page)</h3>
                    <p class="text-xs text-gray-500">Shown at the bottom of the material detail page. Leave blank to use site defaults.</p>
                    <x-admin.input label="Eyebrow" name="cta_eyebrow" :value="$item->cta_eyebrow" placeholder="Need help choosing?" />
                    <x-admin.input label="Heading" name="cta_heading" :value="$item->cta_heading" placeholder="Not sure which material is right for your project?" />
                    <x-admin.textarea label="Body" name="cta_body" :value="$item->cta_body" :rows="4" />
                    <div class="grid gap-4 md:grid-cols-3">
                        <x-admin.input label="Primary Button Label" name="cta_primary_label" :value="$item->cta_primary_label" placeholder="Get an Estimate" />
                        <x-admin.input label="Secondary Button Label" name="cta_secondary_label" :value="$item->cta_secondary_label" placeholder="Contact Us" />
                        <x-admin.input label="Secondary Button URL" name="cta_secondary_url" :value="$item->cta_secondary_url" placeholder="/contact" />
                    </div>
                </div>

                <div class="space-y-4 border-t border-gray-100 pt-8">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">SEO</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        <x-admin.input label="SEO Title" name="meta_title" :value="$item->meta_title" />
                        <x-admin.input label="SEO Description" name="meta_description" :value="$item->meta_description" />
                    </div>
                </div>

                <div class="space-y-4 border-t border-gray-100 pt-8">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Images</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Card / Fallback Image</label>
                        @if ($item->image_path)
                            <img src="{{ $item->image_path }}" alt="" class="mt-2 mb-2 h-24 w-auto rounded">
                        @endif
                        <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-700">Detail Page Gallery</p>
                        <p class="mt-1 text-xs text-gray-500">Optional extra images for the material detail page hero and gallery grid.</p>

                        @if ($item->exists && $item->images->isNotEmpty())
                            <div class="mt-4 space-y-3">
                                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Current gallery images</p>
                                @foreach ($item->images as $image)
                                    <div class="grid gap-3 rounded-lg border border-gray-200 bg-gray-50/60 p-4 md:grid-cols-[72px_1fr_auto] md:items-center">
                                        <img src="{{ $image->image_path }}" alt="" class="h-16 w-16 rounded border border-gray-200 bg-white object-cover">
                                        <div class="grid gap-3 md:grid-cols-2">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-600">Alt text</label>
                                                <input
                                                    type="text"
                                                    name="existing_gallery[{{ $image->id }}][alt_text]"
                                                    value="{{ old('existing_gallery.'.$image->id.'.alt_text', $image->alt_text) }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                >
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-600">Sort order</label>
                                                <input
                                                    type="number"
                                                    min="0"
                                                    name="existing_gallery[{{ $image->id }}][sort_order]"
                                                    value="{{ old('existing_gallery.'.$image->id.'.sort_order', $image->sort_order) }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                >
                                            </div>
                                        </div>
                                        <label class="inline-flex items-center gap-2 self-start text-xs font-medium text-red-600 md:self-center">
                                            <input type="checkbox" name="remove_gallery[]" value="{{ $image->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            Remove
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-6">
                            <div class="flex items-center justify-between gap-4">
                                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Add gallery images</p>
                                <button
                                    type="button"
                                    id="add-gallery-row"
                                    class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-3 py-2 text-xs font-semibold uppercase tracking-wider text-gray-700 hover:bg-gray-50"
                                >
                                    + Add image
                                </button>
                            </div>
                            <div id="new-gallery-rows" class="mt-3 space-y-3"></div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 border-t border-gray-100 pt-8">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Visibility</h3>
                    <x-admin.input label="Sort Order" name="sort_order" type="number" :value="old('sort_order', $item->sort_order ?? 0)" />
                    <x-admin.checkbox label="Mark as featured" name="is_featured" :checked="old('is_featured', $item->is_featured ?? false)" />
                    <x-admin.checkbox
                        label="Show as informational callout (not a primary material card / page link)"
                        name="is_callout"
                        :checked="old('is_callout', $item->is_callout ?? false)"
                    />
                    <x-admin.checkbox label="Active" name="is_active" :checked="old('is_active', $item->is_active ?? true)" />
                </div>

                <x-admin.form-actions :cancel-route="route('admin.materials.index')" />
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('new-gallery-rows');
            const addButton = document.getElementById('add-gallery-row');

            if (!container || !addButton) return;

            let galleryIndex = 0;

            const createRow = () => {
                const index = galleryIndex++;
                const row = document.createElement('div');
                row.className = 'gallery-row rounded-lg border border-dashed border-gray-300 bg-gray-50/40 p-4';
                row.innerHTML = `
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">New gallery image</p>
                        <button type="button" class="remove-gallery-row text-xs font-medium text-red-600 hover:text-red-700">Remove</button>
                    </div>
                    <div class="mt-3 grid gap-3 md:grid-cols-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-600">Upload image</label>
                            <input
                                type="file"
                                name="gallery_new[${index}][file]"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600">Alt text</label>
                            <input
                                type="text"
                                name="gallery_new[${index}][alt_text]"
                                placeholder="Optional description"
                                class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                        </div>
                    </div>
                `;

                row.querySelector('.remove-gallery-row')?.addEventListener('click', () => row.remove());
                container.appendChild(row);
            };

            addButton.addEventListener('click', createRow);
        });
    </script>
@endpush
