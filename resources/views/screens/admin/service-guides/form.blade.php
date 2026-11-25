@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')
    @include('screens.admin.partials.page-header', ['title' => $title])

    @php
        $buttonRows = function ($collection, $oldKey) {
            return old($oldKey, $collection->map(fn ($b) => [
                'label' => $b->label,
                'url' => $b->url,
                'sort_order' => $b->sort_order,
                'is_active' => $b->is_active,
            ])->all() ?: [['label' => '', 'url' => '', 'sort_order' => 0, 'is_active' => 1]]);
        };
        $materialsRows = old('materials', $materials->map(fn ($m) => [
            'name' => $m->name, 'body' => $m->body, 'image_path' => $m->image_path,
            'sort_order' => $m->sort_order, 'is_active' => $m->is_active,
        ])->all() ?: [['name' => '', 'body' => '', 'image_path' => '', 'sort_order' => 0, 'is_active' => 1]]);
        $stepRows = old('steps', $steps->map(fn ($s) => [
            'step_number' => $s->step_number, 'title' => $s->title, 'body' => $s->body,
            'sort_order' => $s->sort_order, 'is_active' => $s->is_active,
        ])->all() ?: [['step_number' => '', 'title' => '', 'body' => '', 'sort_order' => 0, 'is_active' => 1]]);
        $faqRows = old('faqs', $faqs->map(fn ($f) => [
            'question' => $f->question, 'answer' => $f->answer,
            'sort_order' => $f->sort_order, 'is_active' => $f->is_active,
        ])->all() ?: [['question' => '', 'answer' => '', 'sort_order' => 0, 'is_active' => 1]]);
        $heroButtonRows = $buttonRows($heroButtons, 'hero_buttons');
        $processButtonRows = $buttonRows($processButtons, 'process_buttons');
        $workButtonRows = $buttonRows($workButtons, 'work_buttons');
        $materialsButtonRows = $buttonRows($materialsButtons, 'materials_buttons');
        $advantagesButtonRows = $buttonRows($advantagesButtons, 'advantages_buttons');
        $closingButtonRows = $buttonRows($closingButtons, 'closing_buttons');
    @endphp

    <form id="service-guide-form" method="POST" enctype="multipart/form-data" class="space-y-8"
          action="{{ $item->exists ? route($routeName.'.update', $item) : route($routeName.'.store') }}">
        @csrf
        @if ($item->exists) @method('PUT') @endif

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Page & SEO</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <x-admin.input label="Title" name="title" id="title" :value="$item->title" required />
                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $item->slug) }}" pattern="[a-z0-9]+(-[a-z0-9]+)*" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <p class="mt-1 text-xs text-gray-500">URL: /services/<span id="slug-preview">{{ old('slug', $item->slug ?: 'your-slug') }}</span></p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <x-admin.input label="Meta Title" name="meta_title" :value="$item->meta_title" />
                <x-admin.textarea label="Meta Description" name="meta_description" :value="$item->meta_description" :rows="2" />
            </div>
            <x-admin.textarea label="Hero Intro Text" name="hero_body" :value="$item->hero_body" :rows="3" />
            @include('screens.admin.service-guides.partials.image-field', ['label' => 'Hero Image', 'name' => 'hero_image', 'current' => $item->hero_image_path])
            <div class="mt-4 flex items-center justify-between gap-4 border-t border-gray-200 pt-4">
                <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Hero Buttons</h3>
                <button type="button" data-add-row="hero_buttons" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add Button</button>
            </div>
            <div id="hero_buttons-rows" class="mt-4 space-y-4">
                @foreach ($heroButtonRows as $i => $row)
                    @include('screens.admin.service-guides.partials.button-row', ['prefix' => 'hero_buttons', 'i' => $i, 'row' => $row])
                @endforeach
            </div>
            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-{{ !empty($isServiceArea) ? '2' : '3' }}">
                <x-admin.input label="Sort Order" name="sort_order" type="number" :value="$item->sort_order ?? 0" />
                <x-admin.checkbox label="Active" name="is_active" :checked="$item->is_active ?? true" />
                @unless (!empty($isServiceArea))
                    <x-admin.checkbox label="Show in Services dropdown" name="show_in_nav" :checked="$item->show_in_nav ?? true" />
                @endunless
            </div>
            @if (!empty($isServiceArea))
                <p class="mt-2 text-xs text-gray-500">Service Area pages are managed here and are not shown in the site Services dropdown.</p>
            @endif
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Services / Process Section</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <x-admin.input label="Eyebrow" name="process_eyebrow" :value="$item->process_eyebrow" />
                <x-admin.input label="Heading" name="process_heading" :value="$item->process_heading" />
            </div>
            <x-admin.textarea label="Body" name="process_body" :value="$item->process_body" :rows="4" />
            @include('screens.admin.service-guides.partials.image-field', ['label' => 'Process Image', 'name' => 'process_image', 'current' => $item->process_image_path])
            <div class="mt-6 flex items-center justify-between gap-4">
                <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Process Steps</h3>
                <button type="button" data-add-row="steps" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add Step</button>
            </div>
            <div id="steps-rows" class="mt-4 space-y-4">
                @foreach ($stepRows as $i => $row)
                    <div class="rounded-lg border border-gray-200 p-4" data-row>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                            <x-admin.input label="Number" :name="'steps['.$i.'][step_number]'" :value="$row['step_number'] ?? ''" />
                            <div class="lg:col-span-2"><x-admin.input label="Title" :name="'steps['.$i.'][title]'" :value="$row['title'] ?? ''" /></div>
                            <x-admin.input label="Sort" :name="'steps['.$i.'][sort_order]'" type="number" :value="$row['sort_order'] ?? $i" />
                        </div>
                        <x-admin.textarea label="Body" :name="'steps['.$i.'][body]'" :value="$row['body'] ?? ''" :rows="3" />
                        <x-admin.checkbox label="Active" :name="'steps['.$i.'][is_active]'" :checked="!empty($row['is_active'])" />
                    </div>
                @endforeach
            </div>
            <div class="mt-6 flex items-center justify-between gap-4 border-t border-gray-200 pt-4">
                <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Process Buttons</h3>
                <button type="button" data-add-row="process_buttons" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add Button</button>
            </div>
            <div id="process_buttons-rows" class="mt-4 space-y-4">
                @foreach ($processButtonRows as $i => $row)
                    @include('screens.admin.service-guides.partials.button-row', ['prefix' => 'process_buttons', 'i' => $i, 'row' => $row])
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Our Work Section</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <x-admin.input label="Eyebrow" name="work_eyebrow" :value="$item->work_eyebrow" />
                <x-admin.input label="Heading" name="work_heading" :value="$item->work_heading" />
            </div>
            <x-admin.textarea label="Body" name="work_body" :value="$item->work_body" :rows="4" />
            @include('screens.admin.service-guides.partials.image-field', ['label' => 'Work Image', 'name' => 'work_image', 'current' => $item->work_image_path])
            <div class="mt-6 flex items-center justify-between gap-4 border-t border-gray-200 pt-4">
                <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Work Buttons</h3>
                <button type="button" data-add-row="work_buttons" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add Button</button>
            </div>
            <div id="work_buttons-rows" class="mt-4 space-y-4">
                @foreach ($workButtonRows as $i => $row)
                    @include('screens.admin.service-guides.partials.button-row', ['prefix' => 'work_buttons', 'i' => $i, 'row' => $row])
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Materials Intro</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <x-admin.input label="Eyebrow" name="materials_eyebrow" :value="$item->materials_eyebrow" />
                <x-admin.input label="Heading" name="materials_heading" :value="$item->materials_heading" />
            </div>
            <x-admin.textarea label="Intro" name="materials_intro" :value="$item->materials_intro" :rows="5" />
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Material Cards</h2>
                <button type="button" data-add-row="materials" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add Material</button>
            </div>
            <div id="materials-rows" class="mt-6 space-y-6">
                @foreach ($materialsRows as $i => $row)
                    <div class="rounded-lg border border-gray-200 p-4" data-row>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                            <div class="lg:col-span-2"><x-admin.input label="Name" :name="'materials['.$i.'][name]'" :value="$row['name'] ?? ''" /></div>
                            <x-admin.input label="Sort" :name="'materials['.$i.'][sort_order]'" type="number" :value="$row['sort_order'] ?? $i" />
                            <x-admin.checkbox label="Active" :name="'materials['.$i.'][is_active]'" :checked="!empty($row['is_active'])" />
                        </div>
                        <x-admin.textarea label="Body" :name="'materials['.$i.'][body]'" :value="$row['body'] ?? ''" :rows="4" />
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="hidden" name="materials[{{ $i }}][image_path]" value="{{ $row['image_path'] ?? '' }}">
                            @if (!empty($row['image_path']))
                                <img src="{{ $row['image_path'] }}" alt="" class="mt-2 mb-3 h-28 w-auto max-w-full rounded border object-cover">
                            @endif
                            <input type="file" name="materials[{{ $i }}][image]" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-gray-700 hover:file:bg-gray-200">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Additional Materials</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <x-admin.input label="Eyebrow" name="additional_eyebrow" :value="$item->additional_eyebrow" />
                <x-admin.input label="Heading" name="additional_heading" :value="$item->additional_heading" />
            </div>
            <x-admin.textarea label="Body" name="additional_body" :value="$item->additional_body" :rows="4" />
            <x-admin.textarea label="Help Text" name="additional_help_text" :value="$item->additional_help_text" :rows="3" />
            @include('screens.admin.service-guides.partials.image-field', ['label' => 'Section Image', 'name' => 'additional_image', 'current' => $item->additional_image_path])
            <div class="mt-6 flex items-center justify-between gap-4 border-t border-gray-200 pt-4">
                <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Buttons</h3>
                <button type="button" data-add-row="materials_buttons" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add Button</button>
            </div>
            <div id="materials_buttons-rows" class="mt-4 space-y-4">
                @foreach ($materialsButtonRows as $i => $row)
                    @include('screens.admin.service-guides.partials.button-row', ['prefix' => 'materials_buttons', 'i' => $i, 'row' => $row])
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Advantages</h2>
            <div class="mt-6">
                <x-admin.input label="Heading" name="advantages_heading" :value="$item->advantages_heading" />
                <x-admin.textarea label="Body" name="advantages_body" :value="$item->advantages_body" :rows="4" />
                @include('screens.admin.service-guides.partials.image-field', ['label' => 'Section Image', 'name' => 'advantages_image', 'current' => $item->advantages_image_path])
            </div>
            <div class="mt-6 flex items-center justify-between gap-4 border-t border-gray-200 pt-4">
                <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Buttons</h3>
                <button type="button" data-add-row="advantages_buttons" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add Button</button>
            </div>
            <div id="advantages_buttons-rows" class="mt-4 space-y-4">
                @foreach ($advantagesButtonRows as $i => $row)
                    @include('screens.admin.service-guides.partials.button-row', ['prefix' => 'advantages_buttons', 'i' => $i, 'row' => $row])
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">FAQ</h2>
                    <x-admin.input label="FAQ Heading" name="faq_heading" :value="$item->faq_heading" />
                </div>
                <button type="button" data-add-row="faqs" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add FAQ</button>
            </div>
            <div id="faqs-rows" class="mt-6 space-y-6">
                @foreach ($faqRows as $i => $row)
                    <div class="rounded-lg border border-gray-200 p-4" data-row>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                            <div class="lg:col-span-2"><x-admin.input label="Question" :name="'faqs['.$i.'][question]'" :value="$row['question'] ?? ''" /></div>
                            <x-admin.input label="Sort" :name="'faqs['.$i.'][sort_order]'" type="number" :value="$row['sort_order'] ?? $i" />
                            <x-admin.checkbox label="Active" :name="'faqs['.$i.'][is_active]'" :checked="!empty($row['is_active'])" />
                        </div>
                        <x-admin.textarea label="Answer" :name="'faqs['.$i.'][answer]'" :value="$row['answer'] ?? ''" :rows="3" />
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Closing CTA</h2>
            <div class="mt-6">
                <x-admin.input label="Heading" name="cta_heading" :value="$item->cta_heading" />
                <x-admin.textarea label="Body" name="cta_body" :value="$item->cta_body" :rows="4" />
            </div>
            <div class="mt-6 flex items-center justify-between gap-4 border-t border-gray-200 pt-4">
                <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-700">Buttons</h3>
                <button type="button" data-add-row="closing_buttons" class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-semibold uppercase tracking-widest text-gray-700">Add Button</button>
            </div>
            <div id="closing_buttons-rows" class="mt-4 space-y-4">
                @foreach ($closingButtonRows as $i => $row)
                    @include('screens.admin.service-guides.partials.button-row', ['prefix' => 'closing_buttons', 'i' => $i, 'row' => $row])
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg">
            <x-admin.form-actions :cancel-route="route($routeName.'.index')" />
        </div>
    </form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const slugPreview = document.getElementById('slug-preview');
    let slugEdited = Boolean(slugInput.value);
    const slugify = (value) => value.toLowerCase().trim().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    slugInput.addEventListener('input', () => { slugEdited = slugInput.value.length > 0; slugPreview.textContent = slugInput.value || 'your-slug'; });
    titleInput.addEventListener('input', () => { if (!slugEdited) slugPreview.textContent = slugify(titleInput.value) || 'your-slug'; });

    const buttonTemplate = (prefix, i) => `
        <div class="grid grid-cols-1 gap-4 rounded-lg border border-gray-200 p-4 lg:grid-cols-4" data-row>
            <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Label</label><input type="text" name="${prefix}[${i}][label]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
            <div class="mb-4"><label class="block text-sm font-medium text-gray-700">URL / Link</label><input type="text" name="${prefix}[${i}][url]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
            <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Sort</label><input type="number" name="${prefix}[${i}][sort_order]" value="${i}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
            <div class="mb-4 flex items-end"><label class="inline-flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="${prefix}[${i}][is_active]" value="1" checked class="rounded border-gray-300"> Active</label></div>
        </div>`;

    const templates = {
        materials: (i) => `
            <div class="rounded-lg border border-gray-200 p-4" data-row>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                    <div class="mb-4 lg:col-span-2"><label class="block text-sm font-medium text-gray-700">Name</label><input type="text" name="materials[${i}][name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Sort</label><input type="number" name="materials[${i}][sort_order]" value="${i}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    <div class="mb-4 flex items-end"><label class="inline-flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="materials[${i}][is_active]" value="1" checked class="rounded border-gray-300"> Active</label></div>
                </div>
                <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Body</label><textarea name="materials[${i}][body]" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea></div>
                <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Image</label><input type="hidden" name="materials[${i}][image_path]" value=""><input type="file" name="materials[${i}][image]" accept="image/*" class="mt-1 block w-full text-sm text-gray-500"></div>
            </div>`,
        steps: (i) => `
            <div class="rounded-lg border border-gray-200 p-4" data-row>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Number</label><input type="text" name="steps[${i}][step_number]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    <div class="mb-4 lg:col-span-2"><label class="block text-sm font-medium text-gray-700">Title</label><input type="text" name="steps[${i}][title]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Sort</label><input type="number" name="steps[${i}][sort_order]" value="${i}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                </div>
                <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Body</label><textarea name="steps[${i}][body]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea></div>
                <label class="inline-flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="steps[${i}][is_active]" value="1" checked class="rounded border-gray-300"> Active</label>
            </div>`,
        faqs: (i) => `
            <div class="rounded-lg border border-gray-200 p-4" data-row>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                    <div class="mb-4 lg:col-span-2"><label class="block text-sm font-medium text-gray-700">Question</label><input type="text" name="faqs[${i}][question]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Sort</label><input type="number" name="faqs[${i}][sort_order]" value="${i}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    <div class="mb-4 flex items-end"><label class="inline-flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="faqs[${i}][is_active]" value="1" checked class="rounded border-gray-300"> Active</label></div>
                </div>
                <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Answer</label><textarea name="faqs[${i}][answer]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea></div>
            </div>`,
        hero_buttons: (i) => buttonTemplate('hero_buttons', i),
        process_buttons: (i) => buttonTemplate('process_buttons', i),
        work_buttons: (i) => buttonTemplate('work_buttons', i),
        materials_buttons: (i) => buttonTemplate('materials_buttons', i),
        advantages_buttons: (i) => buttonTemplate('advantages_buttons', i),
        closing_buttons: (i) => buttonTemplate('closing_buttons', i),
    };

    document.querySelectorAll('[data-add-row]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const key = btn.getAttribute('data-add-row');
            const container = document.getElementById(`${key}-rows`);
            const i = container.querySelectorAll('[data-row]').length;
            container.insertAdjacentHTML('beforeend', templates[key](i));
        });
    });
});
</script>
@endpush
