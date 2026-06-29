@props(['label', 'name', 'value' => '', 'required' => false, 'rows' => 4])

<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if($required) required @endif
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    >{{ old($name, $value) }}</textarea>
</div>
