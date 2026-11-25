@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
        <a
            href="{{ route('admin.faqs.create') }}"
            class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700"
        >
            Add FAQ
        </a>
    </div>

    <div class="mb-8 bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Section Headings</h2>
            <p class="mt-1 text-sm text-gray-500">Controls the FAQ section title shown on the homepage above “Start your project”.</p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.faqs.section.update') }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <x-admin.input
                        label="Eyebrow"
                        name="faq_eyebrow"
                        :value="old('faq_eyebrow', $sectionValues['faq_eyebrow'])"
                        placeholder="FAQ"
                    />
                    <x-admin.input
                        label="Main Heading"
                        name="faq_heading"
                        :value="old('faq_heading', $sectionValues['faq_heading'])"
                        placeholder="Frequently asked questions"
                    />
                </div>

                <x-admin.textarea
                    label="Subheading (optional)"
                    name="faq_subheading"
                    :value="old('faq_subheading', $sectionValues['faq_subheading'])"
                    :rows="2"
                />

                <div class="mt-4">
                    <x-primary-button>Save FAQ Section</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Questions</h2>
            <p class="mt-1 text-sm text-gray-500">Only active FAQs appear on the homepage.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Question</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Answer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $item->sort_order }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->question }}</td>
                            <td class="max-w-sm truncate px-6 py-4 text-sm text-gray-600">{{ $item->answer }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $item->is_active ? 'Yes' : 'No' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                <x-admin.row-actions
                                    :edit-route="route('admin.faqs.edit', $item)"
                                    :destroy-route="route('admin.faqs.destroy', $item)"
                                    confirm="Delete this FAQ?"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No FAQs yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
