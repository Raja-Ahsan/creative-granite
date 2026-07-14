<x-guest-layout>
    <h1 class="font-display text-2xl text-cream text-center mb-6">Sign In</h1>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-cream/70" />
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                autocapitalize="characters"
                spellcheck="false"
                oninput="this.value = this.value.toLowerCase()"
                class="block mt-1 w-full rounded-sm shadow-sm border-cream/20 bg-white text-ink placeholder:text-ink-soft/40 focus:border-accent focus:ring-accent"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-cream/70" />
            <x-text-input
                id="password"
                class="block mt-1 w-full border-cream/20 bg-ink text-cream placeholder:text-cream/40 focus:border-accent focus:ring-accent"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-cream/30 bg-ink text-accent shadow-sm focus:ring-accent" name="remember">
                <span class="ms-2 text-sm text-cream/70">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6 gap-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-cream/60 hover:text-accent transition" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif

            <x-primary-button class="!bg-cream !text-ink hover:!bg-bone focus:ring-offset-ink !tracking-normal !text-sm">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
