<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Services\EmailTemplateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmailTemplateController extends Controller
{
    public function __construct(private EmailTemplateService $emailTemplates) {}

    public function index(): View
    {
        return view('screens.admin.email-templates.index', [
            'items' => EmailTemplate::query()->orderBy('sort_order')->orderBy('name')->get(),
            'title' => 'Email Templates',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.email-templates.form', $this->formData(
            new EmailTemplate(),
            'Create Email Template',
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['name']);

        EmailTemplate::create($data);

        return redirect()
            ->route('admin.email-templates.index')
            ->with('success', 'Email template created.');
    }

    public function edit(EmailTemplate $emailTemplate): View
    {
        return view('screens.admin.email-templates.form', $this->formData(
            $emailTemplate,
            'Edit Email Template',
        ));
    }

    public function update(Request $request, EmailTemplate $emailTemplate): RedirectResponse
    {
        $data = $this->validated($request, $emailTemplate);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['name'], $emailTemplate);

        $emailTemplate->update($data);

        return redirect()
            ->route('admin.email-templates.index')
            ->with('success', 'Email template updated.');
    }

    public function destroy(EmailTemplate $emailTemplate): RedirectResponse
    {
        if ($emailTemplate->is_system) {
            return redirect()
                ->route('admin.email-templates.index')
                ->with('error', 'System templates cannot be deleted. You can deactivate them instead.');
        }

        $emailTemplate->delete();

        return redirect()
            ->route('admin.email-templates.index')
            ->with('success', 'Email template deleted.');
    }

    private function validated(Request $request, ?EmailTemplate $template = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('email_templates', 'slug')->ignore($template?->id),
            ],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => (int) ($request->input('sort_order') ?? 0),
        ];
    }

    private function resolveSlug(?string $slug, string $name, ?EmailTemplate $template = null): string
    {
        $base = filled($slug) ? $slug : Str::slug($name);
        $candidate = $base;
        $suffix = 1;

        while (
            EmailTemplate::query()
                ->where('slug', $candidate)
                ->when($template, fn ($query) => $query->where('id', '!=', $template->id))
                ->exists()
        ) {
            $candidate = $base.'-'.$suffix;
            $suffix++;
        }

        return $candidate;
    }

    private function formData(EmailTemplate $item, string $title): array
    {
        return [
            'item' => $item,
            'title' => $title,
            'mergeTags' => $this->emailTemplates->placeholderLabels(),
            'previewSamples' => $this->emailTemplates->samplePreviewVariables(),
        ];
    }
}
