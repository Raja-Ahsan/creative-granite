@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.process-steps.update', $item) : route('admin.process-steps.store') }}">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Step Number" name="step_number" :value="$item->step_number" placeholder="01" required />
                <x-admin.input label="Title" name="title" :value="$item->title" required />
                <x-admin.textarea label="Description" name="description" :value="$item->description" required />
                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="$item->sort_order ?? 0" />
                <x-admin.checkbox label="Active" name="is_active" :checked="$item->is_active ?? true" />

                <x-admin.form-actions :cancel-route="route('admin.process-steps.index')" />
            </form>
        </div>
    </div>
@endsection
