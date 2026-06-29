@props(['label', 'name', 'checked' => false])

<div {{ $attributes->merge(['class' => 'mb-4 flex items-center']) }}>
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $name }}"
        value="1"
        @checked(old($name, $checked))
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
    />
    <label for="{{ $name }}" class="ms-2 text-sm text-gray-700">{{ $label }}</label>
</div>
