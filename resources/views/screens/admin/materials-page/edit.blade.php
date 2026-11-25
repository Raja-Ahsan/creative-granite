@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form id="materials-page-form" method="POST" action="{{ route('admin.materials-page.update') }}" class="space-y-6">
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
                    <p class="mt-1 text-xs text-gray-500">Homepage Materials intro text. Formatting is supported.</p>
                    <textarea id="materials_section_subheading" name="materials_section_subheading" rows="6" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('materials_section_subheading', $values['materials_section_subheading']) }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Products Page Intro</h3>
                    <p class="mt-1 text-sm text-gray-500">Clickable material cards still come from Materials. This copy appears above those cards on /products.</p>
                </div>
                <x-admin.input label="Products Eyebrow" name="materials_products_eyebrow" :value="old('materials_products_eyebrow', $values['materials_products_eyebrow'])" />
                <x-admin.input label="Products Heading" name="materials_products_heading" :value="old('materials_products_heading', $values['materials_products_heading'])" />
                <div>
                    <label class="block text-sm font-medium text-gray-700">Products Subheading</label>
                    <p class="mt-1 text-xs text-gray-500">Products page Materials intro text. Formatting is supported.</p>
                    <textarea id="materials_products_subheading" name="materials_products_subheading" rows="6" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('materials_products_subheading', $values['materials_products_subheading']) }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Additional Materials Callout</h3>
                    <p class="mt-1 text-sm text-gray-500">Shown under the material cards on the homepage, and as the Additional Materials block on the Products page.</p>
                </div>
                <x-admin.input label="Eyebrow" name="materials_callout_eyebrow" :value="old('materials_callout_eyebrow', $values['materials_callout_eyebrow'])" />
                <x-admin.input label="Heading" name="materials_callout_heading" :value="old('materials_callout_heading', $values['materials_callout_heading'])" />
                <div>
                    <label class="block text-sm font-medium text-gray-700">Body</label>
                    <p class="mt-1 text-xs text-gray-500">Callout paragraph. Formatting is supported.</p>
                    <textarea id="materials_callout_body" name="materials_callout_body" rows="6" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('materials_callout_body', $values['materials_callout_body']) }}</textarea>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <x-admin.input label="Button Label" name="materials_callout_button_label" :value="old('materials_callout_button_label', $values['materials_callout_button_label'])" />
                    <x-admin.input label="Button URL" name="materials_callout_button_url" :value="old('materials_callout_button_url', $values['materials_callout_button_url'])" placeholder="/contact" />
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Help Choosing CTA</h3>
                    <p class="mt-1 text-sm text-gray-500">Dark banner under Materials on the homepage and Products page (“Need help choosing?”).</p>
                </div>
                <x-admin.input label="Eyebrow" name="materials_help_eyebrow" :value="old('materials_help_eyebrow', $values['materials_help_eyebrow'])" placeholder="Need help choosing?" />
                <x-admin.input label="Heading" name="materials_help_heading" :value="old('materials_help_heading', $values['materials_help_heading'])" placeholder="Not sure which material is right for your project?" />
                <div>
                    <label class="block text-sm font-medium text-gray-700">Body</label>
                    <p class="mt-1 text-xs text-gray-500">Main paragraph under the heading. Formatting is supported.</p>
                    <textarea id="materials_help_body" name="materials_help_body" rows="6" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('materials_help_body', $values['materials_help_body']) }}</textarea>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <x-admin.input label="Primary Button Label" name="materials_help_primary_label" :value="old('materials_help_primary_label', $values['materials_help_primary_label'])" placeholder="Start Your Project" />
                    <x-admin.input label="Primary Button URL" name="materials_help_primary_url" :value="old('materials_help_primary_url', $values['materials_help_primary_url'])" placeholder="#estimate" />
                </div>
                <p class="text-xs text-gray-500">Use <code class="rounded bg-gray-100 px-1">#estimate</code> to open the estimate modal.</p>
                <div class="grid gap-4 md:grid-cols-2">
                    <x-admin.input label="Secondary Button Label" name="materials_help_secondary_label" :value="old('materials_help_secondary_label', $values['materials_help_secondary_label'])" placeholder="Visit the Showroom" />
                    <x-admin.input label="Secondary Button URL" name="materials_help_secondary_url" :value="old('materials_help_secondary_url', $values['materials_help_secondary_url'])" placeholder="Leave blank for showroom map / contact" />
                </div>
                <p class="text-xs text-gray-500">Leave Secondary URL blank to use the showroom map link from Site Settings (falls back to /contact).</p>

                <x-admin.form-actions :cancel-route="route('admin.materials.index')" />
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.0/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('materials-page-form')?.addEventListener('submit', () => {
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }
            });

            tinymce.init({
                selector: '#materials_section_subheading, #materials_products_subheading, #materials_callout_body, #materials_help_body',
                license_key: 'gpl',
                base_url: 'https://cdn.jsdelivr.net/npm/tinymce@7.6.0',
                suffix: '.min',
                height: 260,
                menubar: false,
                plugins: ['advlist', 'autolink', 'lists', 'link', 'charmap', 'code', 'wordcount'],
                toolbar:
                    'undo redo | bold italic underline | bullist numlist | link | removeformat code',
                branding: false,
                promotion: false,
                convert_urls: true,
                relative_urls: false,
                remove_script_host: false,
                content_style:
                    'body { font-family: "Helvetica Neue", Arial, sans-serif; font-size: 14px; line-height: 1.6; }',
            });
        });
    </script>
@endpush
