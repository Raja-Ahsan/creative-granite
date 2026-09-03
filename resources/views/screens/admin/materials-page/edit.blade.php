@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.materials-page.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <p class="text-sm text-gray-500">
                    These settings control the homepage Materials section intro.
                    Individual material cards and detail pages are managed under
                    <a href="{{ route('admin.materials.index') }}" class="text-indigo-600 underline">Materials</a>.
                </p>

                <x-admin.input label="Eyebrow" name="materials_section_eyebrow" :value="old('materials_section_eyebrow', $values['materials_section_eyebrow'])" />
                <x-admin.input label="Heading" name="materials_section_heading" :value="old('materials_section_heading', $values['materials_section_heading'])" />
                <div>
                    <label class="block text-sm font-medium text-gray-700">Subheading</label>
                    <textarea name="materials_section_subheading" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('materials_section_subheading', $values['materials_section_subheading']) }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Products Page Intro</h3>
                    <p class="mt-1 text-sm text-gray-500">Clickable material cards still come from Materials. This copy appears above those cards on /products.</p>
                </div>
                <x-admin.input label="Products Eyebrow" name="materials_products_eyebrow" :value="old('materials_products_eyebrow', $values['materials_products_eyebrow'])" />
                <x-admin.input label="Products Heading" name="materials_products_heading" :value="old('materials_products_heading', $values['materials_products_heading'])" />
                <div>
                    <label class="block text-sm font-medium text-gray-700">Products Subheading</label>
                    <textarea name="materials_products_subheading" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('materials_products_subheading', $values['materials_products_subheading']) }}</textarea>
                </div>

                <x-admin.form-actions :cancel-route="route('admin.materials.index')" />
            </form>
        </div>
    </div>
@endsection
