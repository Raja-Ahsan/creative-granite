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

                <x-admin.form-actions :cancel-route="route('admin.materials.index')" />
            </form>
        </div>
    </div>
@endsection
