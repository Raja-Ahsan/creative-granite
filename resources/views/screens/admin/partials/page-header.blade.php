<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">{{ $title ?? 'Admin' }}</h1>
    </div>

    @if (!empty($actionRoute))
        <a
            href="{{ $actionRoute }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
            {{ $actionLabel ?? 'Add New' }}
        </a>
    @endif
</div>
