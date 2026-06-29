@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-bone bg-white text-ink placeholder:text-ink-soft/40 focus:border-accent focus:ring-accent rounded-sm shadow-sm']) }}>
