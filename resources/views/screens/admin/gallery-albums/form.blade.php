@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.gallery-albums.update', $item) : route('admin.gallery-albums.store') }}" enctype="multipart/form-data">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Title" name="title" :value="old('title', $item->title)" required />
                <x-admin.input label="Slug (optional — auto from title)" name="slug" :value="old('slug', $item->slug)" placeholder="kitchens" />

                <div class="mb-4">
                    <label for="kind" class="block text-sm font-medium text-gray-700">Type</label>
                    <select id="kind" name="kind" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="category" @selected(old('kind', $item->kind) === 'category')>Category (top grid on /work)</option>
                        <option value="project" @selected(old('kind', $item->kind) === 'project')>Featured Project (bottom grid on /work)</option>
                    </select>
                    @error('kind')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-admin.textarea
                    label="Description (detail page intro)"
                    name="description"
                    :value="old('description', $item->description)"
                    :rows="3"
                    placeholder="A photo gallery from this collection — browse the images below."
                />

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Cover Image (card on /work)</label>
                    @if ($item->cover_path)
                        <img src="{{ $item->cover_path }}" alt="" class="mt-2 mb-2 h-28 w-auto rounded object-cover">
                    @endif
                    <input type="file" name="cover" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    @error('cover')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Collage Images (detail page gallery)</label>
                    @php
                        $collageCount = $item->exists ? $item->images->count() : 0;
                        $maxCollage = 12;
                        $remainingCollage = max(0, $maxCollage - $collageCount);
                    @endphp
                    <p class="mt-1 text-xs text-gray-500">
                        You can upload up to <strong>{{ $maxCollage }}</strong> images (add a few now, more later).
                        Current: <strong>{{ $collageCount }}</strong> / {{ $maxCollage }}
                        @if ($remainingCollage > 0)
                            — <strong>{{ $remainingCollage }}</strong> slots left.
                        @else
                            — collage is full.
                        @endif
                    </p>

                    @if ($item->exists && $item->images->isNotEmpty())
                        <p class="mt-3 text-xs text-gray-500">Use <strong>Sort</strong> to set display order on the detail page (lower numbers appear first). Then click Save.</p>
                        <div class="mt-3 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                            @foreach ($item->images->sortBy(['sort_order', 'id']) as $collageImage)
                                <div class="overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
                                    <img src="{{ $collageImage->image_path }}" alt="" class="h-28 w-full object-cover bg-white">
                                    <div class="space-y-2 border-t border-gray-200 bg-white p-2">
                                        <label class="block text-[10px] font-semibold uppercase tracking-wider text-gray-500">
                                            Sort
                                            <input
                                                type="number"
                                                min="0"
                                                name="existing_collage[{{ $collageImage->id }}][sort_order]"
                                                value="{{ old('existing_collage.'.$collageImage->id.'.sort_order', $collageImage->sort_order) }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            >
                                        </label>
                                        <label class="inline-flex items-center gap-2 text-xs text-red-600">
                                            <input
                                                type="checkbox"
                                                name="remove_collage_images[]"
                                                value="{{ $collageImage->id }}"
                                                class="rounded border-gray-300 text-red-600 focus:ring-red-500"
                                            >
                                            Remove
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('existing_collage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('existing_collage.*.sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    @endif

                    <input type="file" name="collage_images[]" accept="image/*" multiple class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700 hover:file:bg-gray-200">
                    @error('collage_images')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('collage_images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="old('sort_order', $item->sort_order ?? 0)" />
                <x-admin.checkbox label="Active (show on site)" name="is_active" :checked="old('is_active', $item->is_active ?? true)" />

                <x-admin.form-actions :cancel-route="route('admin.gallery-albums.index')" />
            </form>
        </div>
    </div>
@endsection
