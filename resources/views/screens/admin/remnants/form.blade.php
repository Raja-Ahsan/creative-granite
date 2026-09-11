@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.remnants.update', $item) : route('admin.remnants.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Name / Color" name="name" :value="$item->name" required placeholder="Taj Mahal" />
                <div class="grid gap-6 md:grid-cols-2">
                    <x-admin.input label="Material" name="material" :value="$item->material" placeholder="Quartzite" />
                    <x-admin.input label="Finish" name="finish" :value="$item->finish" placeholder="Polished" />
                </div>
                <div class="grid gap-6 md:grid-cols-2">
                    <x-admin.input label="Approx. Size" name="dimensions" :value="$item->dimensions" placeholder='72" × 30"' />
                    <x-admin.input label="Thickness" name="thickness" :value="$item->thickness" placeholder='3cm' />
                </div>
                <div class="grid gap-6 md:grid-cols-2">
                    <x-admin.input label="Remnant / Slab ID" name="remnant_code" :value="$item->remnant_code" placeholder="R-1042" />
                    <x-admin.input label="Quantity" name="quantity" type="number" :value="old('quantity', $item->quantity)" />
                </div>
                <x-admin.input label="Price Label" name="price_label" :value="$item->price_label" placeholder="Request Pricing" />
                <x-admin.input label="Project Suitability" name="suitability" :value="$item->suitability" placeholder="Vanities, laundry rooms, smaller projects" />
                <x-admin.textarea label="Description" name="description" :value="$item->description" :rows="4" />

                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    @if ($item->image_path)
                        <img src="{{ $item->image_path }}" alt="" class="mt-2 mb-2 h-28 w-auto rounded object-cover">
                        <label class="mb-2 inline-flex items-center gap-2 text-xs font-medium text-red-600">
                            <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            Remove photo
                        </label>
                    @endif
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                </div>

                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="old('sort_order', $item->sort_order ?? 0)" />
                <x-admin.checkbox label="Published (visible on site)" name="is_active" :checked="old('is_active', $item->is_active ?? true)" />

                @php
                    $availabilityStatus = old('availability_status', $item->availability_status ?? ($item->is_available ? 'available' : 'coming_soon'));
                @endphp
                <div>
                    <span class="block text-sm font-medium text-gray-700">Availability</span>
                    <div class="mt-3 flex flex-wrap gap-6">
                        <label class="inline-flex items-center gap-2 text-sm text-gray-800">
                            <input
                                type="radio"
                                name="availability_status"
                                value="available"
                                class="border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                @checked($availabilityStatus === 'available')
                            >
                            Available
                        </label>
                        <label class="inline-flex items-center gap-2 text-sm text-gray-800">
                            <input
                                type="radio"
                                name="availability_status"
                                value="coming_soon"
                                class="border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                @checked($availabilityStatus === 'coming_soon')
                            >
                            Coming Soon
                        </label>
                    </div>
                    @error('availability_status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-admin.form-actions :cancel-route="route('admin.remnants.index')" />
            </form>
        </div>
    </div>
@endsection
