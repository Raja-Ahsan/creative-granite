@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.products-page.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <p class="text-sm text-gray-500">These settings control the hero section on the public <a href="/products" target="_blank" class="text-indigo-600 underline">/products</a> page. Product cards come from the All Products list (active items only).</p>

                <x-admin.input label="Eyebrow" name="products_page_eyebrow" :value="old('products_page_eyebrow', $values['products_page_eyebrow'])" />
                <x-admin.input label="Heading" name="products_page_heading" :value="old('products_page_heading', $values['products_page_heading'])" />
                <div>
                    <label class="block text-sm font-medium text-gray-700">Subheading</label>
                    <textarea name="products_page_subheading" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('products_page_subheading', $values['products_page_subheading']) }}</textarea>
                </div>

                <x-admin.form-actions :cancel-route="route('admin.products.index')" />
            </form>
        </div>
    </div>
@endsection
