<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @if ($current)
        <img src="{{ $current }}" alt="" class="mt-2 mb-3 h-40 w-auto max-w-full rounded border object-cover">
        <label class="mb-3 flex items-center gap-2 text-sm text-gray-600">
            <input type="checkbox" name="remove_{{ $name }}" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            Remove current image
        </label>
    @endif
    <input type="file" name="{{ $name }}" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-gray-700 hover:file:bg-gray-200">
</div>
