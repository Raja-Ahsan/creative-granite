@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.edge-profiles.update', $item) : route('admin.edge-profiles.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Name" name="name" :value="$item->name" required placeholder="Dupont Edge" />
                <x-admin.textarea label="Description" name="description" :value="$item->description" :rows="3" placeholder="Flat top transitioning into a sculpted curved profile." />

                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <p class="mt-1 text-xs text-gray-500">Lifestyle or close-up photo of the finished edge.</p>
                    @if ($item->image_path)
                        <img src="{{ $item->image_path }}" alt="" class="mt-2 mb-2 h-28 w-auto rounded object-cover">
                    @endif
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Edge Graphic / Diagram</label>
                    <p class="mt-1 text-xs text-gray-500">Optional line drawing or schematic of the profile.</p>
                    @if ($item->diagram_path)
                        <img src="{{ $item->diagram_path }}" alt="" class="mt-2 mb-2 h-24 w-auto rounded object-contain bg-gray-50 p-2">
                        <label class="mb-2 inline-flex items-center gap-2 text-xs font-medium text-red-600">
                            <input type="checkbox" name="remove_diagram" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            Remove diagram
                        </label>
                    @endif
                    <input type="file" name="diagram" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                </div>

                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="old('sort_order', $item->sort_order ?? 0)" />
                <x-admin.checkbox label="Active" name="is_active" :checked="old('is_active', $item->is_active ?? true)" />

                <x-admin.form-actions :cancel-route="route('admin.edge-profiles.index')" />
            </form>
        </div>
    </div>
@endsection
