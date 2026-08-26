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
                            <label class="block text-sm font-medium text-gray-700">Material</label>
                            <input
                                list="material-options"
                                name="material"
                                value="{{ old('material', $item->material) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            <datalist id="material-options">
                                @foreach ($materialOptions as $option)
                                    <option value="{{ $option }}"></option>
                                @endforeach
                            </datalist>
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
                    <p class="mt-1 text-xs text-gray-500">Used on the products page. If you add color variants below, the first variant becomes the primary image automatically.</p>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        <div>
                            @if ($item->image_path)
                                <img src="{{ $item->image_path }}" alt="" class="mb-3 h-36 w-auto rounded border border-gray-200 bg-gray-50 object-contain p-2">
                            @endif
                            <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Or image path</label>
                            <input
                                type="text"
                                name="image_path"
                                value="{{ old('image_path', $item->image_path) }}"
                                list="available-product-images"
                                placeholder="/images/products/1000 White.png"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            <datalist id="available-product-images">
                                @foreach ($availableImages as $imagePath)
                                    <option value="{{ $imagePath }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Color Variation Images</h3>
                    <p class="mt-1 text-xs text-gray-500">Add multiple finishes for the same model. These appear as color swatches on the product page.</p>

                    @if ($item->exists && $item->images->isNotEmpty())
                        <div class="mt-4 space-y-3">
                            @foreach ($item->images as $image)
                                <div class="grid gap-3 rounded-lg border border-gray-200 p-4 md:grid-cols-[80px_1fr_120px_auto] md:items-center">
                                    <img src="{{ $image->image_path }}" alt="" class="h-16 w-16 rounded bg-gray-50 object-contain p-1">
                                    <div class="min-w-0">
                                        <p class="truncate text-xs text-gray-500">{{ $image->image_path }}</p>
                                        <input
                                            type="text"
                                            name="existing_variants[{{ $image->id }}][label]"
                                            value="{{ old('existing_variants.'.$image->id.'.label', $image->alt_text) }}"
                                            placeholder="Finish label (White, Black...)"
                                            class="mt-2 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                    </div>
                                    <input
                                        type="number"
                                        name="existing_variants[{{ $image->id }}][sort_order]"
                                        value="{{ old('existing_variants.'.$image->id.'.sort_order', $image->sort_order) }}"
                                        min="0"
                                        class="block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                    <label class="inline-flex items-center gap-2 text-xs text-red-600">
                                        <input type="checkbox" name="remove_variants[]" value="{{ $image->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                        Remove
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-6 rounded-lg border border-dashed border-gray-300 p-4">
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Add by image path</p>
                        @for ($i = 0; $i < 3; $i++)
                            <div class="mt-3 grid gap-3 md:grid-cols-[1fr_180px]">
                                <input
                                    type="text"
                                    name="variant_paths[]"
                                    value="{{ old('variant_paths.'.$i) }}"
                                    list="available-product-images"
                                    placeholder="/images/products/1000 Black.png"
                                    class="block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                <input
                                    type="text"
                                    name="variant_labels[]"
                                    value="{{ old('variant_labels.'.$i) }}"
                                    placeholder="Finish label"
                                    class="block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                        @endfor
                    </div>

                    <div class="mt-4 rounded-lg border border-dashed border-gray-300 p-4">
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Upload new variation images</p>
                        <input type="file" name="variant_files[]" accept="image/*" multiple class="mt-3 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700">
                        <p class="mt-2 text-xs text-gray-500">Optional labels in order, comma-separated (e.g. White, Black, Beige)</p>
                        <input
                            type="text"
                            name="variant_file_labels_csv"
                            value="{{ old('variant_file_labels_csv') }}"
                            placeholder="White, Black, Beige"
                            class="mt-2 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
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
            const fileInput = document.querySelector('input[name="variant_files[]"]');
            const csvInput = document.querySelector('input[name="variant_file_labels_csv"]');
            const form = fileInput?.closest('form');

            if (!form || !fileInput || !csvInput) return;

            form.addEventListener('submit', () => {
                document.querySelectorAll('input[name^="variant_file_labels["]').forEach((node) => node.remove());

                const labels = csvInput.value
                    .split(',')
                    .map((label) => label.trim())
                    .filter(Boolean);

                labels.forEach((label, index) => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = `variant_file_labels[${index}]`;
                    hidden.value = label;
                    form.appendChild(hidden);
                });
            });
        });
    </script>
@endpush
