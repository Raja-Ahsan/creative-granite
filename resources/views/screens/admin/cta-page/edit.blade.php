@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.cta-page.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <p class="text-sm text-gray-500">
                    Controls the “Start your project” CTA on the homepage and other pages that reuse this block.
                    Contact page hero heading/body also use these fields.
                </p>

                <x-admin.input
                    label="Eyebrow (optional)"
                    name="cta_eyebrow"
                    :value="old('cta_eyebrow', $values['cta_eyebrow'])"
                    placeholder="Final Call to Action"
                />

                <x-admin.input
                    label="Heading"
                    name="cta_heading"
                    :value="old('cta_heading', $values['cta_heading'])"
                    placeholder="Start your project"
                />

                <x-admin.textarea
                    label="Body"
                    name="cta_body"
                    :value="old('cta_body', $values['cta_body'])"
                    :rows="4"
                />

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Primary Button</h3>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <x-admin.input
                        label="Button Label"
                        name="cta_button_label"
                        :value="old('cta_button_label', $values['cta_button_label'])"
                        placeholder="Get an Estimate"
                    />
                    <x-admin.input
                        label="Button URL"
                        name="cta_button_url"
                        :value="old('cta_button_url', $values['cta_button_url'])"
                        placeholder="#estimate"
                    />
                </div>
                <p class="text-xs text-gray-500">Use <code class="rounded bg-gray-100 px-1">#estimate</code> to open the estimate modal.</p>

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Secondary Links</h3>
                </div>
                <x-admin.input
                    label="Showroom Link Label"
                    name="cta_showroom_label"
                    :value="old('cta_showroom_label', $values['cta_showroom_label'])"
                    placeholder="Visit our showroom"
                />
                <p class="text-xs text-gray-500">Link URL comes from Site Settings → Showroom Maps URL. Link hides if that URL is empty.</p>

                <div class="grid gap-4 md:grid-cols-2">
                    <x-admin.input
                        label="Appointment Link Label"
                        name="cta_appointment_label"
                        :value="old('cta_appointment_label', $values['cta_appointment_label'])"
                        placeholder="Or book an appointment"
                    />
                    <x-admin.input
                        label="Appointment Link URL"
                        name="cta_appointment_url"
                        :value="old('cta_appointment_url', $values['cta_appointment_url'])"
                        placeholder="/contact"
                    />
                </div>

                <x-admin.form-actions :cancel-route="route('admin.dashboard')" />
            </form>
        </div>
    </div>
@endsection
