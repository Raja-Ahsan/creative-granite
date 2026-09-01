@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.product-categories.update', $item) : route('admin.product-categories.store') }}">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Category Name" name="name" :value="$item->name" required placeholder="Stainless Steel" />
                <p class="-mt-3 mb-4 text-xs text-gray-500">Full name shown on product cards and section headings.</p>

                <x-admin.input label="Short Label" name="short_name" :value="$item->short_name" placeholder="Steel" />
                <p class="-mt-3 mb-4 text-xs text-gray-500">Optional shorter label for the filter pills. Leave blank to use the full name.</p>

                <x-admin.input label="Slug" name="slug" :value="$item->slug" placeholder="stainless-steel" />
                <p class="-mt-3 mb-4 text-xs text-gray-500">URL-friendly identifier. Auto-generated from the name if left blank.</p>

                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="old('sort_order', $item->sort_order ?? 0)" />
                <x-admin.checkbox label="Active" name="is_active" :checked="old('is_active', $item->is_active ?? true)" />

                <x-admin.form-actions :cancel-route="route('admin.product-categories.index')" />
            </form>
        </div>
    </div>
@endsection
