<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Services\EmailTemplateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailComposeController extends Controller
{
    public function __construct(private EmailTemplateService $templates) {}

    public function create(Request $request): View
    {
        $templates = EmailTemplate::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $selected = null;
        $placeholders = [];

        if ($request->filled('email_template_id')) {
            $selected = $templates->firstWhere('id', (int) $request->input('email_template_id'));

            if ($selected) {
                $placeholders = $selected->placeholders();
            }
        }

        return view('screens.admin.email-templates.compose', [
            'title' => 'Send Email',
            'templates' => $templates,
            'selected' => $selected,
            'placeholders' => $placeholders,
            'placeholderLabels' => $this->templates->placeholderLabels(),
        ]);
    }

    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email_template_id' => ['required', 'exists:email_templates,id'],
            'to_email' => ['required', 'email', 'max:255'],
            'to_name' => ['nullable', 'string', 'max:255'],
            'cc' => ['nullable', 'string', 'max:500'],
            'variables' => ['nullable', 'array'],
            'variables.*' => ['nullable', 'string', 'max:5000'],
        ]);

        $template = EmailTemplate::query()
            ->where('is_active', true)
            ->findOrFail($validated['email_template_id']);

        $variables = $validated['variables'] ?? [];
        $variables['sender_name'] ??= auth()->user()?->name ?? config('mail.from.name');

        foreach ($template->placeholders() as $placeholder) {
            if (blank($variables[$placeholder] ?? null)) {
                return redirect()
                    ->route('admin.email.compose', ['email_template_id' => $template->id])
                    ->withInput()
                    ->with('error', 'Please fill in all template variables.');
            }
        }

        try {
            $this->templates->send(
                $template,
                $validated['to_email'],
                $variables,
                $validated['to_name'] ?? null,
                $validated['cc'] ?? null,
            );
        } catch (\Throwable $exception) {
            report($exception);

            return redirect()
                ->route('admin.email.compose', ['email_template_id' => $template->id])
                ->withInput()
                ->with('error', 'Email could not be sent: '.$exception->getMessage());
        }

        return redirect()
            ->route('admin.email.compose', ['email_template_id' => $template->id])
            ->with('success', 'Email sent to '.$validated['to_email'].'.');
    }
}
