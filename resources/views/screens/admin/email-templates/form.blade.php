@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <form
                id="email-template-form"
                method="POST"
                action="{{ $item->exists ? route('admin.email-templates.update', $item) : route('admin.email-templates.store') }}"
                novalidate
            >
                @csrf
                @if ($item->exists) @method('PUT') @endif

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <x-admin.input label="Template Name" name="name" id="name" :value="old('name', $item->name)" required />
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            value="{{ old('slug', $item->slug) }}"
                            placeholder="follow-up"
                            pattern="[a-z0-9]+(-[a-z0-9]+)*"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                        <p class="mt-1 text-xs text-gray-500">Leave blank to auto-generate from name.</p>
                    </div>
                </div>

                <x-admin.input label="Email Subject" name="subject" :value="old('subject', $item->subject)" required />

                <div id="form-client-error" class="hidden rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"></div>

                <x-admin.textarea label="Description (admin only)" name="description" :value="old('description', $item->description)" :rows="2" />

                <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
                    <div>
                        <div class="mb-3 flex flex-wrap items-center justify-between gap-2">
                            <label for="body" class="block text-sm font-medium text-gray-700">Email Content</label>
                            <span class="text-xs text-gray-500">Visual editor — no HTML required</span>
                        </div>

                        <div class="mb-3 rounded-md border border-indigo-100 bg-indigo-50 p-3">
                            <p class="mb-2 text-xs font-medium uppercase tracking-wider text-indigo-900">Insert merge tag</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($mergeTags as $tag => $label)
                                    <button
                                        type="button"
                                        class="merge-tag-btn rounded-full border border-indigo-200 bg-white px-3 py-1 text-xs font-medium text-indigo-800 transition hover:border-indigo-400 hover:bg-indigo-100"
                                        data-tag="{{ $tag }}"
                                        title="{{ $label }}"
                                    >
                                        {{ $label }}
                                    </button>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-indigo-800/80">
                                Click a tag to insert it where your cursor is. Tags are replaced with real values when you send.
                            </p>
                        </div>

                        <textarea
                            name="body"
                            id="body"
                            rows="14"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('body', $item->body) }}</textarea>

                        @if ($item->exists && $item->placeholders())
                            <p class="mt-2 text-xs text-gray-500">
                                Tags used in this template:
                                <span class="font-medium text-gray-700">{{ $item->placeholderListText() }}</span>
                            </p>
                        @endif
                    </div>

                    <div class="xl:sticky xl:top-6 xl:self-start">
                        @include('screens.admin.email-templates.partials.live-preview')
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 gap-6 border-t border-gray-200 pt-8 md:grid-cols-2">
                    <x-admin.input label="Sort Order" name="sort_order" type="number" :value="old('sort_order', $item->sort_order ?? 0)" />
                    <div class="flex items-end pb-2">
                        <x-admin.checkbox label="Active" name="is_active" :checked="old('is_active', $item->is_active ?? true)" />
                    </div>
                </div>

                <x-admin.form-actions
                    :cancel-route="route('admin.email-templates.index')"
                    :submit-label="$item->exists ? 'Update Template' : 'Create Template'"
                />
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.0/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const previewSamples = @json($previewSamples);
            const form = document.getElementById('email-template-form');
            const nameInput = form.querySelector('[name="name"]');
            const subjectInput = form.querySelector('[name="subject"]');
            const bodyInput = document.getElementById('body');
            const clientError = document.getElementById('form-client-error');
            const previewSubject = document.getElementById('email-preview-subject');
            const previewBody = document.getElementById('email-preview-body');
            const useSamplesToggle = document.getElementById('preview-use-samples');
            let previewTimer = null;

            const showClientError = (message) => {
                clientError.textContent = message;
                clientError.classList.remove('hidden');
                clientError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            };

            const hideClientError = () => {
                clientError.classList.add('hidden');
                clientError.textContent = '';
            };

            const editorHasContent = (html) => html.replace(/<[^>]+>/g, '').replace(/&nbsp;/g, ' ').trim().length > 0;

            const replaceMergeTags = (content, useSamples) => {
                if (!content) {
                    return '';
                }

                if (!useSamples) {
                    return content;
                }

                let rendered = content;
                Object.entries(previewSamples).forEach(([key, value]) => {
                    const pattern = new RegExp('\\{\\{\\s*' + key + '\\s*\\}\\}', 'g');
                    rendered = rendered.replace(pattern, value);
                });

                return rendered;
            };

            const updatePreview = () => {
                const useSamples = useSamplesToggle.checked;
                const subject = subjectInput.value.trim() || 'Your email subject will appear here';
                const editor = typeof tinymce !== 'undefined' ? tinymce.get('body') : null;
                const body = editor ? editor.getContent() : document.getElementById('body').value;

                previewSubject.textContent = replaceMergeTags(subject, useSamples);
                previewBody.innerHTML = body
                    ? replaceMergeTags(body, useSamples)
                    : '<p class="text-sm text-gray-400">Start typing in the editor to preview your email.</p>';
            };

            const schedulePreview = () => {
                clearTimeout(previewTimer);
                previewTimer = setTimeout(updatePreview, 200);
            };

            document.getElementById('email-template-form').addEventListener('submit', (event) => {
                hideClientError();

                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }

                if (!nameInput.value.trim()) {
                    event.preventDefault();
                    showClientError('Template name is required.');
                    nameInput.focus();
                    return;
                }

                if (!subjectInput.value.trim()) {
                    event.preventDefault();
                    showClientError('Email subject is required.');
                    subjectInput.focus();
                    return;
                }

                if (!editorHasContent(bodyInput.value)) {
                    event.preventDefault();
                    showClientError('Email content is required. Add text in the editor before saving.');
                    tinymce.get('body')?.focus();
                }
            });

            subjectInput.addEventListener('input', schedulePreview);
            useSamplesToggle.addEventListener('change', updatePreview);

            document.querySelectorAll('.merge-tag-btn').forEach((button) => {
                button.addEventListener('click', () => {
                    const tag = button.dataset.tag;
                    const editor = tinymce.get('body');

                    if (editor) {
                        editor.focus();
                        editor.insertContent('{' + '{' + tag + '}' + '}');
                        schedulePreview();
                    }
                });
            });

            tinymce.init({
                selector: '#body',
                license_key: 'gpl',
                base_url: 'https://cdn.jsdelivr.net/npm/tinymce@7.6.0',
                suffix: '.min',
                height: 480,
                menubar: false,
                statusbar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                    'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'table', 'help', 'wordcount', 'autoresize',
                ],
                toolbar:
                    'undo redo | blocks | bold italic underline | ' +
                    'alignleft aligncenter alignright | bullist numlist outdent indent | ' +
                    'link table | removeformat code fullscreen',
                block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3',
                branding: false,
                promotion: false,
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
                content_style:
                    'body { font-family: "Biondi Sans", "Helvetica Neue", Arial, sans-serif; font-size: 16px; line-height: 1.7; color: #2a2622; text-transform: none; } ' +
                    'h1,h2,h3,h4,h5,h6 { font-family: Luxerie, Didot, "Bodoni 72", "Times New Roman", serif; font-weight: 400; text-transform: uppercase; } ' +
                    'p { margin: 0 0 1em; } h2, h3 { margin: 0 0 0.75em; font-weight: 600; }',
                setup: (editor) => {
                    editor.on('init change keyup undo redo SetContent', schedulePreview);
                    editor.on('init', updatePreview);
                },
            });
        });
    </script>
@endpush
