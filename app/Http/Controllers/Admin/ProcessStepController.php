<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProcessStepController extends Controller
{
    private const SECTION_KEYS = [
        'process_eyebrow',
        'process_heading',
        'process_subheading',
    ];

    public function index(): View
    {
        return view('screens.admin.process-steps.index', [
            'items' => ProcessStep::query()->orderBy('sort_order')->get(),
            'sectionValues' => $this->sectionValues(),
            'title' => 'Process',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.process-steps.form', ['item' => new ProcessStep(), 'title' => 'Add Process Step']);
    }

    public function store(Request $request): RedirectResponse
    {
        ProcessStep::create($this->validated($request));

        return redirect()->route('admin.process-steps.index')->with('success', 'Process step created.');
    }

    public function edit(ProcessStep $processStep): View
    {
        return view('screens.admin.process-steps.form', ['item' => $processStep, 'title' => 'Edit Process Step']);
    }

    public function update(Request $request, ProcessStep $processStep): RedirectResponse
    {
        $processStep->update($this->validated($request, $processStep));

        return redirect()->route('admin.process-steps.index')->with('success', 'Process step updated.');
    }

    public function destroy(ProcessStep $processStep): RedirectResponse
    {
        $processStep->delete();

        return redirect()->route('admin.process-steps.index')->with('success', 'Process step deleted.');
    }

    public function updateSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'process_eyebrow' => ['nullable', 'string', 'max:120'],
            'process_heading' => ['nullable', 'string', 'max:255'],
            'process_subheading' => ['nullable', 'string', 'max:500'],
        ]);

        foreach (self::SECTION_KEYS as $key) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $data[$key] ?? '', 'type' => 'string', 'group' => 'process']
            );
        }

        return redirect()
            ->route('admin.process-steps.index')
            ->with('success', 'Process section updated.');
    }

    private function sectionValues(): array
    {
        $defaults = [
            'process_eyebrow' => 'Project timeline',
            'process_heading' => 'Four steps, no surprises.',
            'process_subheading' => '',
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SECTION_KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }

    private function validated(Request $request, ?ProcessStep $processStep = null): array
    {
        return $request->validate([
            'step_number' => ['required', 'string', 'max:4'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', 0),
        ];
    }
}
