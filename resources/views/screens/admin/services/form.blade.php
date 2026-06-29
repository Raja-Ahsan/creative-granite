@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.services.update', $item) : route('admin.services.store') }}">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Title" name="title" :value="$item->title" required />
                <x-admin.textarea label="Body" name="body" :value="$item->body" required :rows="6" />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-admin.input label="Sort Order" name="sort_order" type="number" :value="$item->sort_order ?? 0" />
                    <x-admin.checkbox label="Active" name="is_active" :checked="$item->is_active ?? true" />
                </div>

                <x-admin.form-actions :cancel-route="route('admin.services.index')" />
            </form>
        </div>
    </div>
@endsection
