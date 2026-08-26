@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.products.update', $item) : route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <div class="grid gap-4 md:grid-cols-2">
                    <x-admin.input label="Model / Name" name="name" :value="$item->name" required />
                    <x-admin.input label="Model Code" name="model" :value="$item->model" />
                    <x-admin.input label="Material" name="material" :value="$item->material" />
                    <x-admin.input label="Mount" name="mount" :value="$item->mount" />
                    <x-admin.input label="Gauge" name="gauge" :value="$item->gauge" />
                    <x-admin.input label="Construction" name="construction" :value="$item->construction" />
                </div>

                <div class="mt-4">
                    <x-admin.input label="Bowl Configuration / Description" name="bowl_description" :value="$item->bowl_description" />
                </div>
                <div class="mt-4">
                    <x-admin.input label="Dimensions" name="dimensions" :value="$item->dimensions" />
                </div>
                <div class="mt-4">
                    <x-admin.input label="Colors / Finish" name="colors_finish" :value="$item->colors_finish" />
                </div>
                <div class="mt-4">
                    <x-admin.textarea label="Optional Accessories" name="optional_accessories" :value="$item->optional_accessories" :rows="3" />
                </div>

                <div class="mb-4 mt-6">
                    <label class="block text-sm font-medium text-gray-700">Product Image</label>
                    @if ($item->image_path)
                        <img src="{{ $item->image_path }}" alt="" class="mt-2 mb-2 h-32 w-auto rounded object-contain bg-gray-50">
                    @endif
                    <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    <p class="mt-1 text-xs text-gray-500">Use images from <code>/public/images/products</code> or upload a new image.</p>
                </div>

                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="$item->sort_order ?? 0" />
                <x-admin.checkbox label="Active" name="is_active" :checked="$item->is_active ?? true" />

                <x-admin.form-actions :cancel-route="route('admin.products.index')" />
            </form>
        </div>
    </div>
@endsection
