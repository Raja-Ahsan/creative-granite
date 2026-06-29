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

    @php
        $total = $items->count();
        $active = $items->where('is_active', true)->count();
    @endphp

    <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-ink-soft/60">Site Content</p>
            <h1 class="mt-1 font-display text-3xl text-ink">Hero Slides</h1>
            <p class="mt-2 text-sm text-ink-soft">Manage homepage hero slider images and order.</p>
        </div>
        <a
            href="{{ route('admin.hero-slides.create', absolute: false) }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-ink text-cream text-sm font-medium rounded-lg hover:bg-ink-soft transition shadow-sm"
        >
            <i class="fa-solid fa-plus text-xs"></i>
            Add Slide
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-bone shadow-sm p-5">
            <p class="text-xs uppercase tracking-wider text-ink-soft/70">Total Slides</p>
            <p class="mt-2 text-3xl font-semibold text-ink">{{ $total }}</p>
        </div>
        <div class="bg-white rounded-xl border border-bone shadow-sm p-5">
            <p class="text-xs uppercase tracking-wider text-ink-soft/70">Active</p>
            <p class="mt-2 text-3xl font-semibold text-ink">{{ $active }}</p>
        </div>
        <div class="bg-white rounded-xl border border-bone shadow-sm p-5">
            <p class="text-xs uppercase tracking-wider text-ink-soft/70">Inactive</p>
            <p class="mt-2 text-3xl font-semibold text-ink">{{ $total - $active }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-bone shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-bone flex items-center justify-between">
            <div>
                <h2 class="text-sm font-semibold text-ink">All Slides</h2>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-cream/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-[11px] font-semibold text-ink-soft uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-[11px] font-semibold text-ink-soft uppercase tracking-wider">Preview</th>
                        <th class="px-6 py-3 text-left text-[11px] font-semibold text-ink-soft uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-[11px] font-semibold text-ink-soft uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-bone">
                    @forelse ($items as $item)
                        <tr class="hover:bg-cream/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-bone text-sm font-semibold text-ink">
                                    {{ $item->sort_order }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img
                                    src="{{ $item->image_path }}"
                                    alt="Hero slide"
                                    class="h-14 w-24 object-cover rounded-lg border border-bone shadow-sm"
                                >
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($item->is_active)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-accent/15 text-accent">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-bone text-ink-soft">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a
                                        href="{{ route('admin.hero-slides.edit', $item, absolute: false) }}"
                                        class="inline-flex items-center gap-1.5 text-sm font-medium text-accent hover:text-ink transition"
                                    >
                                        <i class="fa-regular fa-pen-to-square text-xs"></i>
                                        Edit
                                    </a>
                                    <form
                                        action="{{ route('admin.hero-slides.destroy', $item, absolute: false) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Delete this slide?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 text-sm font-medium text-red-600/80 hover:text-red-700 transition">
                                            <i class="fa-regular fa-trash-can text-xs"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <span class="inline-flex h-14 w-14 items-center justify-center rounded-xl bg-bone text-ink-soft mb-4">
                                    <i class="fa-solid fa-images text-xl"></i>
                                </span>
                                <p class="text-sm font-medium text-ink">No hero slides yet</p>
                                <p class="text-xs text-ink-soft mt-1 mb-4">Add your first slide to populate the homepage hero.</p>
                                <a
                                    href="{{ route('admin.hero-slides.create', absolute: false) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-ink text-cream text-sm rounded-lg hover:bg-ink-soft transition"
                                >
                                    <i class="fa-solid fa-plus text-xs"></i>
                                    Add Slide
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
