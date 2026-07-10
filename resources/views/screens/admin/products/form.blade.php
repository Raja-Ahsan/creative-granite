@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.products.update', $item) : route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Name" name="name" :value="$item->name" required />
                <x-admin.textarea label="Short Excerpt" name="excerpt" :value="$item->excerpt" :rows="2" />
                <x-admin.textarea label="Description" name="description" :value="$item->description" required />

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Main Image</label>
                    @if ($item->image_path)
                        <img src="{{ $item->image_path }}" alt="" class="mt-2 mb-2 h-24 w-auto rounded">
                    @endif
                    <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Related Images</label>
                    <p class="mt-1 text-xs text-gray-500">Additional images shown on the product detail page. You can select multiple files.</p>

                    @if ($item->exists && $item->images->isNotEmpty())
                        <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($item->images as $relatedImage)
                                <label class="group relative block cursor-pointer rounded-lg border border-gray-200 overflow-hidden hover:border-red-300">
                                    <img src="{{ $relatedImage->image_path }}" alt="" class="h-28 w-full object-cover">
                                    <div class="absolute inset-x-0 bottom-0 bg-black/60 px-2 py-1.5">
                                        <span class="flex items-center gap-2 text-xs text-white">
                                            <input type="checkbox" name="remove_related_images[]" value="{{ $relatedImage->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            Remove
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif

                    <input type="file" name="related_images[]" accept="image/*" multiple class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                </div>

                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="$item->sort_order ?? 0" />
                <x-admin.checkbox label="Active" name="is_active" :checked="$item->is_active ?? true" />

                <x-admin.form-actions :cancel-route="route('admin.products.index')" />
            </form>
        </div>
    </div>
@endsection
