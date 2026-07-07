@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Project Details</h2>
                </div>
                <div class="p-6">
                    <p class="whitespace-pre-wrap text-sm leading-relaxed text-gray-800">{{ $estimate->message }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Contact Details</h2>
                </div>
                <dl class="divide-y divide-gray-100 px-6 py-2 text-sm">
                    <div class="py-3">
                        <dt class="text-xs uppercase tracking-wider text-gray-500">Name</dt>
                        <dd class="mt-1 font-medium text-gray-900">{{ $estimate->name }}</dd>
                    </div>
                    <div class="py-3">
                        <dt class="text-xs uppercase tracking-wider text-gray-500">Email</dt>
                        <dd class="mt-1">
                            <a href="mailto:{{ $estimate->email }}" class="text-indigo-600 hover:text-indigo-800">{{ $estimate->email }}</a>
                        </dd>
                    </div>
                    @if ($estimate->phone)
                        <div class="py-3">
                            <dt class="text-xs uppercase tracking-wider text-gray-500">Phone</dt>
                            <dd class="mt-1">
                                <a href="tel:{{ $estimate->phone }}" class="text-indigo-600 hover:text-indigo-800">{{ $estimate->phone }}</a>
                            </dd>
                        </div>
                    @endif
                    <div class="py-3">
                        <dt class="text-xs uppercase tracking-wider text-gray-500">Project Type</dt>
                        <dd class="mt-1 text-gray-900">{{ $estimate->projectTypeLabel() }}</dd>
                    </div>
                    <div class="py-3">
                        <dt class="text-xs uppercase tracking-wider text-gray-500">Received</dt>
                        <dd class="mt-1 text-gray-900">{{ $estimate->created_at->format('l, F j, Y \a\t g:i A') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="flex flex-wrap gap-3">
                <a
                    href="mailto:{{ $estimate->email }}?subject={{ rawurlencode('Re: Your Creative Granite estimate request') }}"
                    class="inline-flex flex-1 items-center justify-center rounded-md bg-ink px-4 py-2.5 text-xs font-semibold uppercase tracking-widest text-cream hover:bg-ink/90"
                >
                    Reply by email
                </a>
                <a
                    href="{{ route('admin.estimate-requests.index') }}"
                    class="inline-flex flex-1 items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2.5 text-xs font-semibold uppercase tracking-widest text-gray-700 hover:bg-gray-50"
                >
                    Back to list
                </a>
            </div>
        </div>
    </div>
@endsection
