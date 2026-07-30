@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.service-page-sections.update', $item) : route('admin.service-page-sections.store') }}" enctype="multipart/form-data">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <div class="grid gap-4 md:grid-cols-2">
                    <x-admin.input label="Number Label" name="number_label" :value="old('number_label', $item->number_label)" placeholder="01" required />
                    <x-admin.input label="Sort Order" name="sort_order" type="number" :value="old('sort_order', $item->sort_order ?? 0)" />
                </div>
                <x-admin.input label="Title" name="title" :value="old('title', $item->title)" required />
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Body</label>
                    <textarea name="body" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('body', $item->body) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Hero Image</label>
                    @if ($item->hero_path)
                        <img src="{{ $item->hero_path }}" alt="" class="mt-2 mb-2 h-28 w-auto rounded object-cover">
                    @endif
                    <input type="file" name="hero" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                    @error('hero') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Supporting Images (usually 3)</label>
                    @if ($item->exists && $item->images->isNotEmpty())
                        <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3">
                            @foreach ($item->images as $image)
                                <label class="group relative block cursor-pointer overflow-hidden rounded-lg border border-gray-200 hover:border-red-300">
                                    <img src="{{ $image->image_path }}" alt="" class="h-28 w-full object-cover">
                                    <div class="absolute inset-x-0 bottom-0 bg-black/60 px-2 py-1.5">
                                        <span class="flex items-center gap-2 text-xs text-white">
                                            <input type="checkbox" name="remove_supporting_images[]" value="{{ $image->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            Remove
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="supporting_images[]" accept="image/*" multiple class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                </div>

                <x-admin.checkbox label="Active" name="is_active" :checked="old('is_active', $item->is_active ?? true)" />
                <x-admin.form-actions :cancel-route="route('admin.service-page-sections.index')" />
            </form>
        </div>
    </div>
@endsection
