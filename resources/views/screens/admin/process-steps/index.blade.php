@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
        <a
            href="{{ route('admin.process-steps.create') }}"
            class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700"
        >
            Add Step
        </a>
    </div>

    <div class="mb-8 bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Section Headings</h2>
            <p class="mt-1 text-sm text-gray-500">Controls the eyebrow and main heading on the homepage and process page.</p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.process-steps.section.update') }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <x-admin.input
                        label="Eyebrow"
                        name="process_eyebrow"
                        :value="old('process_eyebrow', $sectionValues['process_eyebrow'])"
                        placeholder="Project timeline"
                    />
                    <x-admin.input
                        label="Main Heading"
                        name="process_heading"
                        :value="old('process_heading', $sectionValues['process_heading'])"
                        placeholder="Four steps, no surprises."
                    />
                </div>

                <x-admin.textarea
                    label="Subheading (optional)"
                    name="process_subheading"
                    :value="old('process_subheading', $sectionValues['process_subheading'])"
                    :rows="2"
                />

                <div class="mt-4">
                    <x-primary-button>Save Headings</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Process Steps</h2>
            <p class="mt-1 text-sm text-gray-500">Cards shown on the website. Up to 3 cards per row — additional cards wrap to the next row.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Step</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->sort_order }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">{{ $item->step_number }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $item->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->is_active ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <x-admin.row-actions
                                    :edit-route="route('admin.process-steps.edit', $item)"
                                    :destroy-route="route('admin.process-steps.destroy', $item)"
                                    confirm="Delete this process step?"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">No process steps yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
