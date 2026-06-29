@extends('layouts.admin.master')
@section('content')
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($errors) && $errors->any())
        <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-800 border border-red-200">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-8">
        <p class="text-xs uppercase tracking-[0.2em] text-ink-soft/60">Site Content</p>
        <h1 class="mt-1 font-display text-3xl text-ink">{{ $title }}</h1>
        <p class="mt-2 text-sm text-ink-soft">
            {{ $item->exists ? 'Update slide image and display order.' : 'Upload a new image for the homepage hero slider.' }}
        </p>
    </div>

    <div class="bg-white rounded-xl border border-bone shadow-sm">
        <div class="px-6 py-4 border-b border-bone">
            <h2 class="text-sm font-semibold text-ink">Slide Details</h2>
        </div>

        <div class="p-6">
            <form
                method="POST"
                action="{{ $item->exists ? route('admin.hero-slides.update', $item, absolute: false) : route('admin.hero-slides.store', absolute: false) }}"
                enctype="multipart/form-data"
            >
                @csrf
                @if ($item->exists) @method('PUT') @endif

                @if ($item->image_path)
                    <div class="mb-6">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-ink-soft/70 mb-2">Current Image</label>
                        <img
                            src="{{ $item->image_path }}"
                            alt="Hero slide preview"
                            class="h-40 w-auto max-w-full object-cover rounded-xl border border-bone shadow-sm"
                        >
                    </div>
                @endif

                <div class="mb-6">
                    <label class="block text-sm font-medium text-ink-soft">
                        Upload Image
                        @unless ($item->exists)
                            <span class="text-red-500">*</span>
                        @endunless
                    </label>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        @unless ($item->exists) required @endunless
                        class="mt-1 block w-full text-sm text-ink-soft file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-ink file:text-cream hover:file:bg-ink-soft"
                    >
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-ink-soft">Sort Order</label>
                        <input
                            type="number"
                            name="sort_order"
                            id="sort_order"
                            value="{{ old('sort_order', $item->sort_order ?? 0) }}"
                            min="0"
                            class="mt-1 block w-full rounded-lg border-bone bg-white text-ink shadow-sm focus:border-accent focus:ring-accent"
                        >
                    </div>
                    <div class="flex items-end pb-1">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active', $item->is_active ?? true))
                                class="rounded border-bone text-accent focus:ring-accent"
                            >
                            <span class="text-sm text-ink-soft">Active on homepage</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-6 border-t border-bone">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-ink text-cream text-sm font-medium rounded-lg hover:bg-ink-soft transition"
                    >
                        <i class="fa-solid fa-check text-xs"></i>
                        {{ $item->exists ? 'Update Slide' : 'Create Slide' }}
                    </button>
                    <a
                        href="{{ route('admin.hero-slides.index', absolute: false) }}"
                        class="inline-flex items-center px-4 py-2.5 border border-bone rounded-lg text-sm font-medium text-ink-soft hover:bg-cream/50 transition"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
