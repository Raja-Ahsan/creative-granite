@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', [
        'title' => $title,
        'actionRoute' => route('admin.service-page-sections.create'),
        'actionLabel' => 'Add Section',
    ])

    <p class="mb-4 text-sm text-gray-600">
        These sections power <strong>/services</strong> (the numbered blocks like 01 New Construction). Homepage Services list is separate under Home Page.
    </p>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Hero</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Images</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm">{{ $item->sort_order }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-mono">{{ $item->number_label }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <img src="{{ $item->hero_path }}" alt="" class="h-12 w-auto rounded object-cover">
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->title }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm">{{ $item->images_count }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                @if ($item->is_active)
                                    <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Yes</span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">No</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('admin.service-page-sections.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.service-page-sections.destroy', $item) }}" method="POST" class="ml-3 inline" onsubmit="return confirm('Delete this section?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500">No sections yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
