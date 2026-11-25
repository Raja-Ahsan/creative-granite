<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    private const SECTION_KEYS = [
        'faq_eyebrow',
        'faq_heading',
        'faq_subheading',
    ];

    public function index(): View
    {
        return view('screens.admin.faqs.index', [
            'items' => Faq::query()->ordered()->get(),
            'sectionValues' => $this->sectionValues(),
            'title' => 'FAQ',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.faqs.form', [
            'item' => new Faq(['is_active' => true, 'sort_order' => 0]),
            'title' => 'Add FAQ',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Faq::create($this->validated($request));

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created.');
    }

    public function edit(Faq $faq): View
    {
        return view('screens.admin.faqs.form', [
            'item' => $faq,
            'title' => 'Edit FAQ',
        ]);
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $faq->update($this->validated($request));

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted.');
    }

    public function updateSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'faq_eyebrow' => ['nullable', 'string', 'max:120'],
            'faq_heading' => ['nullable', 'string', 'max:255'],
            'faq_subheading' => ['nullable', 'string', 'max:500'],
        ]);

        foreach (self::SECTION_KEYS as $key) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $data[$key] ?? '',
                    'type' => 'string',
                    'group' => 'faq',
                ]
            );
        }

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ section updated.');
    }

    private function sectionValues(): array
    {
        $defaults = [
            'faq_eyebrow' => 'FAQ',
            'faq_heading' => 'Frequently asked questions',
            'faq_subheading' => 'Answers to common questions about materials, timelines, and working with our team.',
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SECTION_KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:5000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => (int) $request->input('sort_order', 0),
        ];
    }
}
