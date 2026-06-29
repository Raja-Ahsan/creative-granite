<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-ink border border-transparent rounded-sm font-sans text-xs text-cream uppercase tracking-[0.15em] hover:bg-ink-soft focus:bg-ink-soft active:bg-ink focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-cream transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
