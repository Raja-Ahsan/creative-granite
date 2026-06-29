@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.portfolio-items.update', $item) : route('admin.portfolio-items.store') }}" enctype="multipart/form-data">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <x-admin.input label="Title" name="title" :value="$item->title" required />

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Upload Image</label>
                    <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                </div>

                <x-admin.form-actions :cancel-route="route('admin.portfolio-items.index')" />
            </form>
        </div>
    </div>
@endsection
