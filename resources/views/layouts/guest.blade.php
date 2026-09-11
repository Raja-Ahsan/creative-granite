<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin — {{ config('app.name', 'Creative Granite') }}</title>

        @if (filled(config('services.adobe_fonts.kit')))
            <link rel="stylesheet" href="https://use.typekit.net/{{ config('services.adobe_fonts.kit') }}.css">
        @endif
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-cream antialiased bg-ink">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-10 sm:py-0">
            <div class="text-center">
                <a href="{{ route('home') }}" class="inline-block">
                    <img
                        src="{{ asset('images/site/update-logo.png') }}"
                        alt="Creative Granite & Design"
                        class="h-14 sm:h-16 w-auto mx-auto"
                    >
                </a>
                <p class="mt-4 text-[11px] uppercase tracking-[0.25em] text-cream/50">Admin Panel</p>
            </div>

            <div class="mt-8 w-full border border-cream/20 bg-ink-soft/55 px-6 py-8 shadow-sm sm:max-w-md sm:rounded-sm sm:px-8">
                {{ $slot }}
            </div>

            <a href="{{ route('home') }}" class="mt-8 text-sm text-cream/75 transition hover:text-accent">
                &larr; Back to website
            </a>
        </div>
    </body>
</html>
