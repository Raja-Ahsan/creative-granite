@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
        <div class="flex flex-wrap gap-3">
            <a
                href="{{ route('admin.email.compose') }}"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 transition hover:bg-gray-50"
            >
                Send Email
            </a>
            <a
                href="{{ route('admin.email-templates.create') }}"
                class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700"
            >
                Create Template
            </a>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Variables</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $item->sort_order }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $item->name }}
                                @if ($item->is_system)
                                    <span class="ml-2 rounded bg-gray-100 px-2 py-0.5 text-[10px] uppercase tracking-wider text-gray-600">System</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->subject }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if ($item->placeholders())
                                    {{ $item->placeholderListText() }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->is_active ? 'Yes' : 'No' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                <div class="flex items-center justify-end gap-3">
                                    @if ($item->is_active)
                                        <a
                                            href="{{ route('admin.email.compose', ['email_template_id' => $item->id]) }}"
                                            class="font-medium text-emerald-700 hover:text-emerald-900"
                                        >
                                            Send
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.email-templates.edit', $item) }}" class="font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                    @if (! $item->is_system)
                                        <form action="{{ route('admin.email-templates.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this template?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                No templates yet.
                                <a href="{{ route('admin.email-templates.create') }}" class="text-indigo-600 hover:text-indigo-800">Create one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
