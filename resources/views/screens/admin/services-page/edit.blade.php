@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.services-page.update') }}" enctype="multipart/form-data" class="space-y-10">
                @csrf
                @method('PUT')

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Page Hero</h3>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        <x-admin.input label="Eyebrow" name="services_page_eyebrow" :value="old('services_page_eyebrow', $values['services_page_eyebrow'])" />
                        <x-admin.input label="Heading" name="services_page_heading" :value="old('services_page_heading', $values['services_page_heading'])" />
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Body</label>
                        <textarea name="services_page_body" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('services_page_body', $values['services_page_body']) }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Hero Image</label>
                        @if ($values['services_page_hero_path'])
                            <img src="{{ $values['services_page_hero_path'] }}" alt="" class="mt-2 mb-2 h-28 w-auto rounded object-cover">
                        @endif
                        <input type="file" name="hero_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Repairs & Warranty Block</h3>
                    <div class="mt-4 grid gap-4 md:grid-cols-3">
                        <x-admin.input label="Number" name="services_page_repairs_number" :value="old('services_page_repairs_number', $values['services_page_repairs_number'])" />
                        <x-admin.input label="Eyebrow" name="services_page_repairs_eyebrow" :value="old('services_page_repairs_eyebrow', $values['services_page_repairs_eyebrow'])" />
                        <x-admin.input label="Heading" name="services_page_repairs_heading" :value="old('services_page_repairs_heading', $values['services_page_repairs_heading'])" />
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Body</label>
                        <textarea name="services_page_repairs_body" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('services_page_repairs_body', $values['services_page_repairs_body']) }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Section Image</label>
                        @if ($values['services_page_repairs_image_path'])
                            <img src="{{ $values['services_page_repairs_image_path'] }}" alt="" class="mt-2 mb-2 h-28 w-auto rounded object-cover">
                        @endif
                        <input type="file" name="repairs_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                    </div>
                    <div class="mt-6 grid gap-6 md:grid-cols-2">
                        <div>
                            <x-admin.input label="Warranty Card Title" name="services_page_warranty_title" :value="old('services_page_warranty_title', $values['services_page_warranty_title'])" />
                            <label class="mt-4 block text-sm font-medium text-gray-700">Warranty Points (one per line)</label>
                            <textarea name="services_page_warranty_points" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('services_page_warranty_points', $values['services_page_warranty_points']) }}</textarea>
                            <x-admin.input class="mt-4" label="Warranty CTA Label" name="services_page_warranty_cta" :value="old('services_page_warranty_cta', $values['services_page_warranty_cta'])" />
                        </div>
                        <div>
                            <x-admin.input label="Repairs Card Title" name="services_page_repairs_card_title" :value="old('services_page_repairs_card_title', $values['services_page_repairs_card_title'])" />
                            <label class="mt-4 block text-sm font-medium text-gray-700">Repairs Points (one per line)</label>
                            <textarea name="services_page_repairs_points" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('services_page_repairs_points', $values['services_page_repairs_points']) }}</textarea>
                            <x-admin.input class="mt-4" label="Repairs CTA Label" name="services_page_repairs_cta" :value="old('services_page_repairs_cta', $values['services_page_repairs_cta'])" />
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Final CTA</h3>
                    <div class="mt-4">
                        <x-admin.input label="Heading" name="services_page_cta_heading" :value="old('services_page_cta_heading', $values['services_page_cta_heading'])" />
                        <label class="mt-4 block text-sm font-medium text-gray-700">Body</label>
                        <textarea name="services_page_cta_body" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('services_page_cta_body', $values['services_page_cta_body']) }}</textarea>
                        <x-admin.input class="mt-4" label="Button Label" name="services_page_cta_button" :value="old('services_page_cta_button', $values['services_page_cta_button'])" />
                    </div>
                </div>

                <x-admin.form-actions :cancel-route="route('admin.dashboard')" />
            </form>
        </div>
    </div>
@endsection
