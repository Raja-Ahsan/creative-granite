@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form
                id="service-form"
                method="POST"
                action="{{ $item->exists ? route('admin.services.update', $item) : route('admin.services.store') }}"
                enctype="multipart/form-data"
            >
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <x-admin.input label="Title" name="title" id="title" :value="$item->title" required />
                    <div class="mb-4">
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            value="{{ old('slug', $item->slug) }}"
                            placeholder="custom-url-slug"
                            pattern="[a-z0-9]+(-[a-z0-9]+)*"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                        <p class="mt-1 text-xs text-gray-500">
                            URL: /services/<span id="slug-preview">{{ old('slug', $item->slug ?: 'your-slug') }}</span>
                            — leave blank to auto-generate from title.
                        </p>
                    </div>
                </div>

                <x-admin.textarea label="Excerpt" name="excerpt" :value="$item->excerpt" :rows="3" placeholder="Short summary shown on the services listing page." />

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Main Image</label>
                    @if ($item->main_image_path)
                        <img src="{{ $item->main_image_path }}" alt="" class="mt-2 mb-3 h-40 w-auto max-w-full rounded border object-cover">
                    @endif
                    <input
                        type="file"
                        name="main_image"
                        accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-gray-700 hover:file:bg-gray-200"
                    />
                    <p class="mt-1 text-xs text-gray-500">
                        Shown on the services listing page and below the heading on the service detail page.
                    </p>
                </div>

                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea
                        name="body"
                        id="body"
                        rows="12"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                    >{{ old('body', $item->body) }}</textarea>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <x-admin.input label="Meta Title (SEO)" name="meta_title" :value="$item->meta_title" placeholder="Optional — defaults to service title" />
                    <x-admin.textarea label="Meta Description (SEO)" name="meta_description" :value="$item->meta_description" :rows="2" placeholder="Optional — defaults to excerpt" />
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-admin.input label="Sort Order" name="sort_order" type="number" :value="$item->sort_order ?? 0" />
                    <x-admin.checkbox label="Active" name="is_active" :checked="$item->is_active ?? true" />
                </div>

                <x-admin.form-actions :cancel-route="route('admin.services.index')" />
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.0/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            const slugPreview = document.getElementById('slug-preview');
            let slugEdited = Boolean(slugInput.value);

            const slugify = (value) =>
                value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');

            slugInput.addEventListener('input', () => {
                slugEdited = slugInput.value.length > 0;
                slugPreview.textContent = slugInput.value || 'your-slug';
            });

            titleInput.addEventListener('input', () => {
                if (!slugEdited) {
                    slugPreview.textContent = slugify(titleInput.value) || 'your-slug';
                }
            });

            document.getElementById('service-form').addEventListener('submit', () => {
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }
            });

            tinymce.init({
                selector: '#body',
                license_key: 'gpl',
                base_url: 'https://cdn.jsdelivr.net/npm/tinymce@7.6.0',
                suffix: '.min',
                height: 520,
                menubar: 'file edit view insert format tools table',
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'autoresize',
                ],
                toolbar:
                    'undo redo | blocks | bold italic underline strikethrough | ' +
                    'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' +
                    'link image media table | removeformat code fullscreen',
                block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Blockquote=blockquote',
                automatic_uploads: true,
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
                branding: false,
                promotion: false,
                content_style: 'body { font-family: ui-sans-serif, system-ui, sans-serif; font-size: 15px; line-height: 1.7; } img { max-width: 100%; height: auto; }',
                images_upload_handler: (blobInfo, progress) =>
                    new Promise((resolve, reject) => {
                        const xhr = new XMLHttpRequest();
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', token);

                        xhr.open('POST', @json(route('admin.editor.upload-image')));
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        xhr.upload.onprogress = (event) => {
                            if (event.lengthComputable) {
                                progress((event.loaded / event.total) * 100);
                            }
                        };
                        xhr.onload = () => {
                            if (xhr.status < 200 || xhr.status >= 300) {
                                reject('Upload failed with status ' + xhr.status);
                                return;
                            }
                            const json = JSON.parse(xhr.responseText);
                            resolve(json.location);
                        };
                        xhr.onerror = () => reject('Image upload failed.');
                        xhr.send(formData);
                    }),
            });
        });
    </script>
@endpush
