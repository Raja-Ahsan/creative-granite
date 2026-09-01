@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ $item->exists ? route('admin.products.update', $item) : route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Product Details</h3>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        <x-admin.input label="Model / Name" name="name" :value="old('name', $item->name)" required />
                        <x-admin.input label="Model Code" name="model" :value="old('model', $item->model)" placeholder="ESI-QS1000" />
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select
                                name="product_category_id"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="" disabled @selected(! old('product_category_id', $item->product_category_id))>Select a category</option>
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected((string) old('product_category_id', $item->product_category_id) === (string) $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($categories->isEmpty())
                                <p class="mt-2 text-xs text-amber-700">
                                    No categories yet.
                                    <a href="{{ route('admin.product-categories.create') }}" class="underline">Add a category</a>
                                    before creating products.
                                </p>
                            @endif
                        </div>
                        <x-admin.input label="Mount" name="mount" :value="old('mount', $item->mount)" />
                        <x-admin.input label="Gauge" name="gauge" :value="old('gauge', $item->gauge)" />
                        <x-admin.input label="Construction" name="construction" :value="old('construction', $item->construction)" />
                    </div>
                    <div class="mt-4">
                        <x-admin.input label="Bowl Configuration / Description" name="bowl_description" :value="old('bowl_description', $item->bowl_description)" />
                    </div>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        <x-admin.input label="Dimensions" name="dimensions" :value="old('dimensions', $item->dimensions)" />
                        <x-admin.input label="Colors / Finish" name="colors_finish" :value="old('colors_finish', $item->colors_finish)" placeholder="White; Black; Mocha" />
                    </div>
                    <div class="mt-4">
                        <x-admin.textarea label="Optional Accessories" name="optional_accessories" :value="old('optional_accessories', $item->optional_accessories)" :rows="3" />
                    </div>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        <x-admin.input label="Sort Order" name="sort_order" type="number" :value="old('sort_order', $item->sort_order ?? 0)" />
                        <div class="flex items-end pb-2">
                            <x-admin.checkbox label="Active" name="is_active" :checked="old('is_active', $item->is_active ?? true)" />
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Primary Image</h3>
                    <p class="mt-1 text-xs text-gray-500">Main image shown on the products page. Upload a new file to replace the current image.</p>
                    <div class="mt-4 max-w-md">
                        @if ($item->image_path)
                            <img src="{{ $item->image_path }}" alt="" class="mb-3 h-36 w-auto rounded border border-gray-200 bg-gray-50 object-contain p-2">
                        @endif
                        <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Color Variation Images</h3>
                    <p class="mt-1 text-xs text-gray-500">Add one finish at a time. Accepted formats: JPG, JPEG, PNG, WEBP.</p>

                    @if ($item->exists && $item->images->isNotEmpty())
                        <div class="mt-4 space-y-3">
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Current variations</p>
                            @foreach ($item->images as $image)
                                <div class="grid gap-3 rounded-lg border border-gray-200 bg-gray-50/60 p-4 md:grid-cols-[72px_1fr_auto] md:items-center">
                                    <img src="{{ $image->image_path }}" alt="" class="h-16 w-16 rounded border border-gray-200 bg-white object-contain p-1">
                                    <div class="min-w-0">
                                        <label class="block text-xs font-medium text-gray-600">Finish label</label>
                                        <input
                                            type="text"
                                            name="existing_variants[{{ $image->id }}][label]"
                                            value="{{ old('existing_variants.'.$image->id.'.label', $image->alt_text) }}"
                                            placeholder="White, Black, Beige..."
                                            class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                        <input type="hidden" name="existing_variants[{{ $image->id }}][sort_order]" value="{{ old('existing_variants.'.$image->id.'.sort_order', $image->sort_order) }}">
                                    </div>
                                    <label class="inline-flex items-center gap-2 self-start text-xs font-medium text-red-600 md:self-center">
                                        <input type="checkbox" name="remove_variants[]" value="{{ $image->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                        Remove
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-6">
                        <div class="flex items-center justify-between gap-4">
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Add new variations</p>
                            <button
                                type="button"
                                id="add-variant-row"
                                class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-3 py-2 text-xs font-semibold uppercase tracking-wider text-gray-700 hover:bg-gray-50"
                            >
                                + Add variation
                            </button>
                        </div>

                        <div id="new-variant-rows" class="mt-3 space-y-3"></div>
                    </div>
                </div>

                <x-admin.form-actions :cancel-route="route('admin.products.index')" />
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('new-variant-rows');
            const addButton = document.getElementById('add-variant-row');

            if (!container || !addButton) return;

            let variantIndex = 0;

            const createRow = () => {
                const index = variantIndex++;
                const row = document.createElement('div');
                row.className = 'variant-row rounded-lg border border-dashed border-gray-300 bg-gray-50/40 p-4';
                row.innerHTML = `
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">New variation</p>
                        <button type="button" class="remove-variant-row text-xs font-medium text-red-600 hover:text-red-700">Remove</button>
                    </div>
                    <div class="mt-3 grid gap-3 md:grid-cols-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-600">Upload image</label>
                            <input
                                type="file"
                                name="new_variants[${index}][file]"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600">Finish label</label>
                            <input
                                type="text"
                                name="new_variants[${index}][label]"
                                placeholder="White, Black, Beige..."
                                class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                        </div>
                    </div>
                `;

                row.querySelector('.remove-variant-row')?.addEventListener('click', () => row.remove());

                container.appendChild(row);
            };

            addButton.addEventListener('click', createRow);
            createRow();
        });
    </script>
@endpush
