@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.faqs.update', $item) : route('admin.faqs.store') }}">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Question" name="question" :value="$item->question" required />
                <x-admin.textarea label="Answer" name="answer" :value="$item->answer" :rows="5" required />
                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="$item->sort_order ?? 0" />
                <x-admin.checkbox label="Active" name="is_active" :checked="$item->is_active ?? true" />

                <x-admin.form-actions :cancel-route="route('admin.faqs.index')" />
            </form>
        </div>
    </div>
@endsection
