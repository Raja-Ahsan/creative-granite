@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', [
        'title' => $title,
        'actionRoute' => route('admin.services.create'),
        'actionLabel' => 'Add Service',
    ])

    <div class="mb-6 overflow-hidden rounded-xl border border-bone bg-white shadow-sm">
        <div class="border-b border-bone px-6 py-4">
            <h2 class="text-sm font-semibold text-ink">Section Text</h2>
            <p class="mt-1 text-sm text-ink-soft">Controls the Services label and heading on the homepage Services block.</p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.services.section.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <x-admin.input
                    label="Eyebrow (Services label)"
                    name="homepage_services_eyebrow"
                    :value="old('homepage_services_eyebrow', $sectionValues['homepage_services_eyebrow'])"
                    placeholder="Services"
                />

                <x-admin.textarea
                    label="Heading"
                    name="homepage_services_heading"
                    :value="old('homepage_services_heading', $sectionValues['homepage_services_heading'])"
                    :rows="2"
                    placeholder="Built for builders. Tailored for homes."
                />
                <p class="text-xs text-ink-soft">Shown under the Services label, above the numbered list.</p>

                <div class="pt-2">
                    <x-primary-button>Save Section Text</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->sort_order }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <a href="{{ route('services.show', $item) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                                    /services/{{ $item->slug }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->is_active ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <x-admin.row-actions
                                    :edit-route="route('admin.services.edit', $item)"
                                    :destroy-route="route('admin.services.destroy', $item)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No services yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
