@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', [
        'title' => $title,
        'actionRoute' => route('admin.services.create'),
        'actionLabel' => 'Add Service',
    ])

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->sort_order }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->is_active ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <x-admin.row-actions
                                    :edit-route="route('admin.services.edit', $item)"
                                    :destroy-route="route('admin.services.destroy', $item)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">No services yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
