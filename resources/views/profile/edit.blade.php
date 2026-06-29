@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    <div class="mb-8">
        <p class="text-xs uppercase tracking-[0.2em] text-ink-soft/60">Account</p>
        <h1 class="mt-1 font-display text-3xl text-ink">Profile</h1>
        <p class="mt-2 text-sm text-ink-soft">Manage your account information and password.</p>
    </div>

    <div class="space-y-6 max-w-3xl">
        <div class="bg-white rounded-xl border border-bone shadow-sm">
            <div class="px-6 py-4 border-b border-bone">
                <h2 class="text-sm font-semibold text-ink">Profile Information</h2>
                <p class="mt-1 text-sm text-ink-soft">Update your account profile and email address.</p>
            </div>
            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white rounded-xl border border-bone shadow-sm">
            <div class="px-6 py-4 border-b border-bone">
                <h2 class="text-sm font-semibold text-ink">Update Password</h2>
                <p class="mt-1 text-sm text-ink-soft">Use a long, random password to keep your account secure.</p>
            </div>
            <div class="p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
@endsection
