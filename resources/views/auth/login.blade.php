<x-guest-layout>
    <h1 class="font-display text-2xl text-cream text-center mb-6">Sign In</h1>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-cream/90">{{ __('Email') }}</label>
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
                class="mt-1 block w-full rounded-sm border border-cream/25 bg-cream px-3 py-2.5 text-ink shadow-sm placeholder:text-ink/40 focus:border-accent focus:ring-accent"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <label for="password" class="block text-sm font-medium text-cream/90">{{ __('Password') }}</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="mt-1 block w-full rounded-sm border border-cream/25 bg-cream px-3 py-2.5 text-ink shadow-sm placeholder:text-ink/40 focus:border-accent focus:ring-accent"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-5 block">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-cream/40 bg-cream text-accent shadow-sm focus:ring-accent"
                    name="remember"
                >
                <span class="ms-2 text-sm text-cream/85">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6 flex items-center justify-between gap-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-cream/75 transition hover:text-accent" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif

            <x-primary-button class="!bg-cream !text-ink hover:!bg-bone focus:ring-offset-ink !tracking-normal !text-sm">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
