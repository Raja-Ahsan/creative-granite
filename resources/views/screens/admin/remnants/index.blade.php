@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
        <a
            href="{{ route('admin.remnants.create') }}"
            class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700"
        >
            Add Remnant
        </a>
    </div>

    <div class="mb-8 bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Page &amp; CTA Copy</h2>
            <p class="mt-1 text-sm text-gray-500">
                CTA appears on the Products page under the material guidance section. Page copy powers
                <code>/remnants</code>.
            </p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.remnants.section.update') }}" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <h3 class="text-sm font-semibold text-gray-800">Products page CTA</h3>
                    <div class="mt-4 space-y-6">
                        <x-admin.input label="CTA Heading" name="remnants_cta_heading" :value="old('remnants_cta_heading', $sectionValues['remnants_cta_heading'])" />
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CTA Supporting Text</label>
                            <textarea name="remnants_cta_body" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('remnants_cta_body', $sectionValues['remnants_cta_body']) }}</textarea>
                        </div>
                        <div class="grid gap-6 md:grid-cols-2">
                            <x-admin.input label="CTA Button Label" name="remnants_cta_button_label" :value="old('remnants_cta_button_label', $sectionValues['remnants_cta_button_label'])" />
                            <x-admin.input label="CTA Button URL" name="remnants_cta_button_url" :value="old('remnants_cta_button_url', $sectionValues['remnants_cta_button_url'])" />
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-semibold text-gray-800">Remnants page</h3>
                    <div class="mt-4 space-y-6">
                        <x-admin.input label="Page Heading" name="remnants_page_heading" :value="old('remnants_page_heading', $sectionValues['remnants_page_heading'])" />
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Page Intro</label>
                            <textarea name="remnants_page_subheading" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('remnants_page_subheading', $sectionValues['remnants_page_subheading']) }}</textarea>
                        </div>
                        <x-admin.input label="Coming Soon Heading" name="remnants_coming_soon_heading" :value="old('remnants_coming_soon_heading', $sectionValues['remnants_coming_soon_heading'])" />
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Coming Soon Body</label>
                            <textarea name="remnants_coming_soon_body" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('remnants_coming_soon_body', $sectionValues['remnants_coming_soon_body']) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Shown on /remnants when there are no available published remnants.</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center rounded-md bg-ink px-4 py-2 text-xs font-semibold uppercase tracking-widest text-cream hover:bg-ink-soft">
                    Save Page Content
                </button>
            </form>
        </div>
    </div>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Remnant Listings</h2>
            <p class="mt-1 text-sm text-gray-500">Add, update, mark unavailable, or remove individual remnant listings.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Preview</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Material</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $item->sort_order }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if ($item->image_path)
                                    <img src="{{ $item->image_path }}" alt="" class="h-12 w-16 rounded object-cover">
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">{{ $item->material ?: '—' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                @if (! $item->is_active)
                                    <span class="text-gray-400">Hidden</span>
                                @elseif ($item->is_available)
                                    <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-green-800">Available</span>
                                @else
                                    <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-amber-800">Unavailable</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                <x-admin.row-actions
                                    :edit-route="route('admin.remnants.edit', $item)"
                                    :destroy-route="route('admin.remnants.destroy', $item)"
                                    confirm="Remove this remnant listing?"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">No remnant listings yet. The public page will show Coming Soon until you add available items.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
