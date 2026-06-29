@props(['label', 'name', 'value' => '', 'options' => []])

<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    >
        @if(isset($placeholder))
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $optValue => $optLabel)
            <option value="{{ $optValue }}" @selected(old($name, $value) == $optValue)>{{ $optLabel }}</option>
        @endforeach
    </select>
</div>
