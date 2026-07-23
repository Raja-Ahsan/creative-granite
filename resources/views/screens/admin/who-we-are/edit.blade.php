@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-sm font-semibold text-gray-900">Homepage — Who We Are</h2>
            <p class="mt-1 text-xs text-gray-500">Controls the eyebrow, heading, year, body copy, and image on the homepage.</p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.who-we-are.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-admin.input
                    label="Eyebrow"
                    name="who_we_are_eyebrow"
                    :value="old('who_we_are_eyebrow', $values['who_we_are_eyebrow'])"
                    placeholder="Who we are"
                />

                <x-admin.input
                    label="Heading"
                    name="who_we_are_heading"
                    :value="old('who_we_are_heading', $values['who_we_are_heading'])"
                    placeholder="Built on craftsmanship since"
                />

                <x-admin.input
                    label="Year / Highlight"
                    name="who_we_are_highlight_text"
                    :value="old('who_we_are_highlight_text', $values['who_we_are_highlight_text'])"
                    placeholder="1998"
                />

                <x-admin.textarea
                    label="Body Text"
                    name="who_we_are_body"
                    :value="old('who_we_are_body', $values['who_we_are_body'])"
                    :rows="6"
                />

                @if (!empty($values['about_image_path']))
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        <img
                            src="{{ $values['about_image_path'] }}"
                            alt="Who we are"
                            class="h-40 w-auto max-w-full object-cover rounded border border-gray-200"
                        >
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Section Image</label>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200"
                    >
                    <p class="mt-1 text-xs text-gray-500">Leave empty to keep the current image. Max 10MB.</p>
                </div>

                <x-admin.form-actions :cancel-route="route('admin.dashboard')" submit-label="Save Who We Are" />
            </form>
        </div>
    </div>
@endsection
