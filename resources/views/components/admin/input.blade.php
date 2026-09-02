@props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false, 'placeholder' => ''])

<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($required) required @endif
        placeholder="{{ $placeholder }}"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    />
</div>
