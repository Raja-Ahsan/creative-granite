@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
        <a
            href="{{ route($routeName.'.create') }}"
            class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700"
        >
            {{ $addButtonLabel }}
        </a>
    </div>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Slug</th>
                    @unless ($isServiceArea)
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nav</th>
                    @endunless
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Active</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $item->sort_order }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">/services/{{ $item->slug }}</td>
                        @unless ($isServiceArea)
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->show_in_nav ? 'Yes' : 'No' }}</td>
                        @endunless
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->is_active ? 'Yes' : 'No' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <x-admin.row-actions
                                :edit-route="route($routeName.'.edit', $item)"
                                :destroy-route="route($routeName.'.destroy', $item)"
                                :confirm="$deleteConfirm"
                            />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $isServiceArea ? 5 : 6 }}" class="px-6 py-8 text-center text-sm text-gray-500">{{ $emptyMessage }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
