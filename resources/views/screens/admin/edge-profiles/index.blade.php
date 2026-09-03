@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
        <a
            href="{{ route('admin.edge-profiles.create') }}"
            class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700"
        >
            Add Edge Profile
        </a>
    </div>

    <div class="mb-8 bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Section Copy</h2>
            <p class="mt-1 text-sm text-gray-500">Shown on the Products page between Materials and Sink Selections. Profiles do not link to separate pages.</p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.edge-profiles.section.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <x-admin.input label="Eyebrow" name="edge_profiles_eyebrow" :value="old('edge_profiles_eyebrow', $sectionValues['edge_profiles_eyebrow'])" />
                <x-admin.input label="Heading" name="edge_profiles_heading" :value="old('edge_profiles_heading', $sectionValues['edge_profiles_heading'])" />
                <div>
                    <label class="block text-sm font-medium text-gray-700">Introduction</label>
                    <textarea name="edge_profiles_body" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('edge_profiles_body', $sectionValues['edge_profiles_body']) }}</textarea>
                </div>

                <button type="submit" class="inline-flex items-center rounded-md bg-ink px-4 py-2 text-xs font-semibold uppercase tracking-widest text-cream hover:bg-ink-soft">
                    Save Section Copy
                </button>
            </form>
        </div>
    </div>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Preview</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Active</th>
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
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                @if ($item->is_active)
                                    <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-green-800">Active</span>
                                @else
                                    <span class="text-gray-400">Hidden</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                <x-admin.row-actions
                                    :edit-route="route('admin.edge-profiles.edit', $item)"
                                    :destroy-route="route('admin.edge-profiles.destroy', $item)"
                                    confirm="Delete this edge profile?"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No edge profiles yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
