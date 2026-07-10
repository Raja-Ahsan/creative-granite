@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="xl:col-span-2 space-y-6">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Choose Template</h2>
                </div>
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.email.compose') }}">
                        <label for="email_template_id" class="block text-sm font-medium text-gray-700">Email Template</label>
                        <select
                            id="email_template_id"
                            name="email_template_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            onchange="this.form.submit()"
                        >
                            <option value="">Select a template…</option>
                            @foreach ($templates as $template)
                                <option
                                    value="{{ $template->id }}"
                                    @selected(old('email_template_id', $selected?->id) == $template->id)
                                >
                                    {{ $template->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    @if ($selected)
                        <div class="mt-6 rounded-md border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700">
                            <p class="font-medium text-gray-900">{{ $selected->name }}</p>
                            @if ($selected->description)
                                <p class="mt-1 text-gray-600">{{ $selected->description }}</p>
                            @endif
                            <p class="mt-3"><strong>Subject:</strong> {{ $selected->subject }}</p>
                        </div>
                    @endif
                </div>
            </div>

            @if ($selected)
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Recipient &amp; Variables</h2>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('admin.email.send') }}">
                            @csrf
                            <input type="hidden" name="email_template_id" value="{{ $selected->id }}">

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <x-admin.input
                                    label="To Email"
                                    name="to_email"
                                    type="email"
                                    :value="old('to_email')"
                                    required
                                />
                                <x-admin.input
                                    label="To Name"
                                    name="to_name"
                                    :value="old('to_name')"
                                />
                            </div>

                            <x-admin.input
                                label="CC (optional, comma-separated)"
                                name="cc"
                                :value="old('cc')"
                                placeholder="manager@example.com, sales@example.com"
                            />

                            @if ($placeholders)
                                <div class="mt-8 border-t border-gray-200 pt-8">
                                    <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Template Variables</h3>
                                    <div class="mt-4 grid grid-cols-1 gap-6">
                                        @foreach ($placeholders as $placeholder)
                                            @php
                                                $label = $placeholderLabels[$placeholder] ?? str($placeholder)->replace('_', ' ')->title();
                                                $isLong = in_array($placeholder, ['message', 'notes', 'body'], true);
                                            @endphp

                                            @if ($isLong)
                                                <x-admin.textarea
                                                    :label="$label"
                                                    :name="'variables['.$placeholder.']'"
                                                    :value="old('variables.'.$placeholder, $placeholder === 'sender_name' ? auth()->user()?->name : '')"
                                                    :rows="4"
                                                    :required="true"
                                                />
                                            @else
                                                <x-admin.input
                                                    :label="$label"
                                                    :name="'variables['.$placeholder.']'"
                                                    :value="old('variables.'.$placeholder, $placeholder === 'sender_name' ? auth()->user()?->name : '')"
                                                    :required="true"
                                                />
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <x-admin.form-actions
                                :cancel-route="route('admin.email-templates.index')"
                                submit-label="Send Email"
                            />
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="rounded-md border border-gray-200 bg-gray-50 px-4 py-4 text-sm text-gray-600">
                <p class="font-medium text-gray-800">How it works</p>
                <ol class="mt-3 list-decimal space-y-2 pl-4 text-xs">
                    <li>Select a template from the list.</li>
                    <li>Fill in the recipient and merge tag values.</li>
                    <li>Send — the email uses your SMTP settings from Email Settings.</li>
                </ol>
            </div>

            <div class="rounded-md border border-gray-200 bg-white px-4 py-4 text-sm">
                <p class="font-medium text-gray-800">Need a new template?</p>
                <a href="{{ route('admin.email-templates.create') }}" class="mt-2 inline-block text-sm font-medium text-indigo-600 hover:text-indigo-800">
                    Create email template
                </a>
            </div>
        </div>
    </div>
@endsection
