@props(['cancelRoute', 'submitLabel' => 'Save'])

<div class="flex items-center gap-3 pt-4 border-t border-gray-100 mt-6">
    <x-primary-button>{{ $slot->isEmpty() ? $submitLabel : $slot }}</x-primary-button>
    <a href="{{ $cancelRoute }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
        Cancel
    </a>
</div>
