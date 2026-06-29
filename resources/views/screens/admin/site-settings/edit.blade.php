@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.site-settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($values['logo_path'])
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Header Logo</label>
                        <img src="{{ $values['logo_path'] }}" alt="Header logo" class="h-16 w-auto object-contain rounded border border-gray-200">
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Header Logo</label>
                    <input
                        type="file"
                        name="logo"
                        accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200"
                    >
                </div>

                @if ($values['footer_logo_path'])
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Footer Logo</label>
                        <img src="{{ $values['footer_logo_path'] }}" alt="Footer logo" class="h-16 w-auto object-contain rounded border border-gray-200">
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Footer Logo</label>
                    <input
                        type="file"
                        name="footer_logo"
                        accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200"
                    >
                </div>

                @if ($values['favicon_path'])
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Favicon</label>
                        <img src="{{ $values['favicon_path'] }}" alt="Favicon" class="h-10 w-10 object-contain rounded border border-gray-200">
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Favicon</label>
                    <input
                        type="file"
                        name="favicon"
                        accept="image/*,.ico"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200"
                    >
                </div>

                <x-admin.input
                    label="Footer Copyright Text"
                    name="footer_copyright"
                    :value="old('footer_copyright', $values['footer_copyright'])"
                />

                <x-admin.form-actions :cancel-route="route('admin.dashboard')" submit-label="Save Settings" />
            </form>
        </div>
    </div>
@endsection
