@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.project-types.update', $item) : route('admin.project-types.store') }}">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Name" name="name" :value="$item->name" required placeholder="New construction" />
                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="$item->sort_order ?? 0" />
                <x-admin.checkbox label="Active" name="is_active" :checked="$item->is_active ?? true" />

                <x-admin.form-actions :cancel-route="route('admin.contact-page.edit')" />
            </form>
        </div>
    </div>
@endsection
