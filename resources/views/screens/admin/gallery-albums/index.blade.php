@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', [
        'title' => $title,
        'actionRoute' => route('admin.gallery-albums.create'),
        'actionLabel' => 'Add Album',
    ])

    <div class="mb-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
        <form method="GET" action="{{ route('admin.gallery-albums.index') }}" class="grid grid-cols-1 gap-3 md:grid-cols-12 md:items-end">
            <div class="md:col-span-4">
                <label for="search" class="mb-1 block text-xs font-medium uppercase tracking-wider text-gray-500">Search</label>
                <input
                    id="search"
                    type="text"
                    name="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Search by title or slug..."
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>
            <div class="md:col-span-2">
                <label for="kind" class="mb-1 block text-xs font-medium uppercase tracking-wider text-gray-500">Type</label>
                <select id="kind" name="kind" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="" @selected($filters['kind'] === '')>All</option>
                    <option value="category" @selected($filters['kind'] === 'category')>Category</option>
                    <option value="project" @selected($filters['kind'] === 'project')>Featured Project</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label for="sort" class="mb-1 block text-xs font-medium uppercase tracking-wider text-gray-500">Sort by</label>
                <select id="sort" name="sort" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="sort_order" @selected($filters['sort'] === 'sort_order')>Sort order</option>
                    <option value="title" @selected($filters['sort'] === 'title')>Title</option>
                    <option value="kind" @selected($filters['sort'] === 'kind')>Type</option>
                    <option value="created_at" @selected($filters['sort'] === 'created_at')>Date added</option>
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
                <a href="{{ route('admin.gallery-albums.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 hover:bg-gray-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <p class="mb-4 text-sm text-gray-600">
        These albums power <strong>/gallery</strong> and each collage detail page (<code>/gallery/{slug}</code>).
        Upload a <strong>cover</strong> plus up to <strong>12 collage images</strong> per album (you can add them in batches).
    </p>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Cover</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Collage</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $item->sort_order }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <img src="{{ $item->cover_path }}" alt="" class="h-12 w-auto rounded object-cover">
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->title }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                {{ $item->kind === 'project' ? 'Featured Project' : 'Category' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                {{ $item->images_count }} {{ \Illuminate\Support\Str::plural('image', $item->images_count) }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                <a href="{{ url('/gallery/'.$item->slug) }}" target="_blank" class="text-indigo-600 hover:underline">/gallery/{{ $item->slug }}</a>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                @if ($item->is_active)
                                    <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Yes</span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">No</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('admin.gallery-albums.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.gallery-albums.destroy', $item) }}" method="POST" class="ml-3 inline" onsubmit="return confirm('Delete this album?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500">No gallery albums yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($items->hasPages())
            <div class="border-t border-gray-200 px-6 py-4">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
