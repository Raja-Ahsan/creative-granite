@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
            @if ($unreadCount > 0)
                <p class="mt-1 text-sm text-amber-700">{{ $unreadCount }} unread {{ str('enquiry')->plural($unreadCount) }}</p>
            @endif
        </div>
        <div class="flex flex-wrap gap-3">
            @if ($unreadCount > 0)
                <form method="POST" action="{{ route('admin.contact-inquiries.mark-all-read') }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 hover:bg-gray-50">
                        Mark all read
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="mb-4 flex gap-2">
        <a
            href="{{ route('admin.contact-inquiries.index', ['filter' => 'all']) }}"
            class="rounded-full px-4 py-1.5 text-xs font-medium uppercase tracking-wider {{ $filter === 'all' ? 'bg-ink text-cream' : 'bg-white text-gray-600 border border-gray-200' }}"
        >
            All
        </a>
        <a
            href="{{ route('admin.contact-inquiries.index', ['filter' => 'unread']) }}"
            class="rounded-full px-4 py-1.5 text-xs font-medium uppercase tracking-wider {{ $filter === 'unread' ? 'bg-ink text-cream' : 'bg-white text-gray-600 border border-gray-200' }}"
        >
            Unread
        </a>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Project</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Received</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($items as $item)
                        <tr class="{{ $item->isUnread() ? 'bg-amber-50/40 hover:bg-amber-50/70' : 'hover:bg-gray-50' }}">
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                @if ($item->isUnread())
                                    <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-amber-800">New</span>
                                @else
                                    <span class="text-gray-400">Read</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->projectTypeLabel() }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->created_at->format('M j, Y g:i A') }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.contact-inquiries.show', $item) }}" class="font-medium text-indigo-600 hover:text-indigo-900">View</a>
                                    <form action="{{ route('admin.contact-inquiries.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this enquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                No contact enquiries yet.
                            </td>
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
