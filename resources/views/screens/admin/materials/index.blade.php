@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', [
        'title' => $title,
        'actionRoute' => route('admin.materials.create'),
        'actionLabel' => 'Add Material',
    ])

    <div class="mb-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
        <form method="GET" action="{{ route('admin.materials.index') }}" class="grid grid-cols-1 gap-3 md:grid-cols-12 md:items-end">
            <div class="md:col-span-4">
                <label for="search" class="mb-1 block text-xs font-medium uppercase tracking-wider text-gray-500">Search</label>
                <input
                    id="search"
                    type="text"
                    name="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Search by name..."
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>
            <div class="md:col-span-2">
                <label for="featured" class="mb-1 block text-xs font-medium uppercase tracking-wider text-gray-500">Featured</label>
                <select id="featured" name="featured" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="" @selected($filters['featured'] === '')>All</option>
                    <option value="1" @selected($filters['featured'] === '1')>Featured only</option>
                    <option value="0" @selected($filters['featured'] === '0')>Not featured</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label for="sort" class="mb-1 block text-xs font-medium uppercase tracking-wider text-gray-500">Sort by</label>
                <select id="sort" name="sort" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="sort_order" @selected($filters['sort'] === 'sort_order')>Sort order</option>
                    <option value="name" @selected($filters['sort'] === 'name')>Name</option>
                    <option value="is_featured" @selected($filters['sort'] === 'is_featured')>Featured</option>
                    <option value="created_at" @selected($filters['sort'] === 'created_at')>Date added</option>
                    <option value="id" @selected($filters['sort'] === 'id')>ID</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label for="direction" class="mb-1 block text-xs font-medium uppercase tracking-wider text-gray-500">Direction</label>
                <select id="direction" name="direction" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="asc" @selected($filters['direction'] === 'asc')>Ascending</option>
                    <option value="desc" @selected($filters['direction'] === 'desc')>Descending</option>
                </select>
            </div>
            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="inline-flex flex-1 items-center justify-center rounded-md bg-ink px-4 py-2 text-xs font-semibold uppercase tracking-widest text-cream hover:bg-ink-soft">
                    Apply
                </button>
                <a href="{{ route('admin.materials.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 hover:bg-gray-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Preview</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Featured</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $item->sort_order }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <img src="{{ $item->image_path }}" alt="" class="h-12 w-auto rounded">
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                @if ($item->is_featured)
                                    <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-amber-800">Featured</span>
                                @else
                                    <span class="text-gray-400">No</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                <x-admin.row-actions
                                    :edit-route="route('admin.materials.edit', $item)"
                                    :destroy-route="route('admin.materials.destroy', $item)"
                                    confirm="Delete this material?"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No materials found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($items->hasPages())
            <div class="border-t border-gray-200 px-6 py-4">
                {{ $items->links() }}
            </div>
        @endif
    </div>
@endsection
