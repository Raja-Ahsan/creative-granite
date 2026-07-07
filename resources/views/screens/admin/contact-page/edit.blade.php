@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="space-y-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-sm font-semibold text-gray-900">Contact Information</h2>
                <p class="mt-1 text-xs text-gray-500">Shown on the left side of the contact page form.</p>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.contact-page.update') }}">
                    @csrf
                    @method('PUT')

                    <x-admin.input label="Address Line 1" name="address_line_1" :value="old('address_line_1', $values['address_line_1'])" />
                    <x-admin.input label="Address Line 2" name="address_line_2" :value="old('address_line_2', $values['address_line_2'])" />
                    <x-admin.input label="Hours" name="hours" :value="old('hours', $values['hours'])" placeholder="8am – 5pm · Mon – Fri" />
                    <x-admin.input label="Phone" name="phone" :value="old('phone', $values['phone'])" />
                    <x-admin.input label="Email" name="email" type="email" :value="old('email', $values['email'])" />
                    <x-admin.input label="Directions URL (Google Maps)" name="showroom_maps_url" :value="old('showroom_maps_url', $values['showroom_maps_url'])" />
                    <x-admin.textarea label="Form Intro Text" name="contact_form_intro" :value="old('contact_form_intro', $values['contact_form_intro'])" :rows="3" />

                    <x-admin.form-actions :cancel-route="route('admin.dashboard')" submit-label="Save Contact Info" />
                </form>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-sm font-semibold text-gray-900">Project Types</h2>
                    <p class="mt-1 text-xs text-gray-500">Options shown in the contact form dropdown.</p>
                </div>
                <a href="{{ route('admin.project-types.create') }}" class="inline-flex items-center rounded-md bg-ink px-4 py-2 text-xs font-semibold uppercase tracking-wider text-cream hover:bg-ink/90">
                    Add Project Type
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($projectTypes as $type)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $type->sort_order }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $type->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">{{ $type->slug }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $type->is_active ? 'Yes' : 'No' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <x-admin.row-actions
                                        :edit-route="route('admin.project-types.edit', $type)"
                                        :destroy-route="route('admin.project-types.destroy', $type)"
                                        confirm="Delete this project type?"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No project types yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
