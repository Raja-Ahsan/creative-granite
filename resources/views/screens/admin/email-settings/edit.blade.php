@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    @if (! $usingDatabase)
        <div class="mb-6 rounded-md border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
            Email is currently using <strong>.env</strong> defaults. Save these settings once to manage mail from the admin panel.
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="xl:col-span-2">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">SMTP Configuration</h2>
                    <p class="mt-1 text-sm text-gray-500">Configure outgoing mail for contact form notifications and system emails.</p>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('admin.email-settings.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label for="mail_mailer" class="block text-sm font-medium text-gray-700">Mail Driver</label>
                                <select
                                    id="mail_mailer"
                                    name="mail_mailer"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                    @foreach (['smtp' => 'SMTP', 'log' => 'Log (development)', 'sendmail' => 'Sendmail'] as $value => $label)
                                        <option value="{{ $value }}" @selected(old('mail_mailer', $values['mail_mailer']) === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <x-admin.input label="SMTP Host" name="mail_host" :value="old('mail_host', $values['mail_host'])" placeholder="smtp.mailgun.org" />
                            <x-admin.input label="SMTP Port" name="mail_port" type="number" :value="old('mail_port', $values['mail_port'])" placeholder="587" />

                            <div>
                                <label for="mail_encryption" class="block text-sm font-medium text-gray-700">Encryption</label>
                                <select
                                    id="mail_encryption"
                                    name="mail_encryption"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="" @selected(old('mail_encryption', $values['mail_encryption']) === '')>None</option>
                                    <option value="tls" @selected(old('mail_encryption', $values['mail_encryption']) === 'tls')>TLS</option>
                                    <option value="ssl" @selected(old('mail_encryption', $values['mail_encryption']) === 'ssl')>SSL</option>
                                </select>
                            </div>

                            <x-admin.input label="SMTP Username" name="mail_username" :value="old('mail_username', $values['mail_username'])" placeholder="username@yourdomain.com" />

                            <div class="md:col-span-2">
                                <label for="mail_password" class="block text-sm font-medium text-gray-700">SMTP Password</label>
                                <input
                                    type="password"
                                    id="mail_password"
                                    name="mail_password"
                                    autocomplete="new-password"
                                    placeholder="{{ $values['has_saved_password'] ? 'Leave blank to keep current password' : 'Enter SMTP password' }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                                @if ($values['has_saved_password'])
                                    <p class="mt-1 text-xs text-gray-500">A password is already saved. Leave blank to keep it unchanged.</p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-8 border-t border-gray-200 pt-8">
                            <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Sender &amp; Recipient</h3>
                            <div class="mt-4 grid grid-cols-1 gap-6 md:grid-cols-2">
                                <x-admin.input label="From Email" name="mail_from_address" type="email" :value="old('mail_from_address', $values['mail_from_address'])" required />
                                <x-admin.input label="From Name" name="mail_from_name" :value="old('mail_from_name', $values['mail_from_name'])" required />
                                <div class="md:col-span-2">
                                    <x-admin.input
                                        label="Contact Form Recipient Email"
                                        name="mail_contact_recipient"
                                        type="email"
                                        :value="old('mail_contact_recipient', $values['mail_contact_recipient'])"
                                        required
                                    />
                                    <p class="mt-1 text-xs text-gray-500">Contact form submissions will be sent to this address.</p>
                                </div>
                            </div>
                        </div>

                        <x-admin.form-actions :cancel-route="route('admin.dashboard')" submit-label="Save Email Settings" />
                    </form>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Send Test Email</h2>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600">Verify your settings by sending a test message after saving.</p>
                    <form method="POST" action="{{ route('admin.email-settings.test') }}" class="mt-4 space-y-4">
                        @csrf
                        <x-admin.input
                            label="Send test to"
                            name="test_email"
                            type="email"
                            :value="old('test_email', auth()->user()?->email)"
                            required
                        />
                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-md bg-ink px-4 py-2.5 text-sm font-medium text-cream transition hover:bg-ink/90"
                        >
                            Send Test Email
                        </button>
                    </form>
                </div>
            </div>

            <div class="rounded-md border border-gray-200 bg-gray-50 px-4 py-4 text-sm text-gray-600">
                <p class="font-medium text-gray-800">Recommended SMTP ports</p>
                <ul class="mt-2 space-y-1 text-xs">
                    <li><strong>587</strong> — TLS (most providers)</li>
                    <li><strong>465</strong> — SSL</li>
                    <li><strong>25</strong> — Unencrypted (often blocked)</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
