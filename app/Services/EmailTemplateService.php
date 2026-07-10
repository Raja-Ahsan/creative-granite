<?php

namespace App\Services;

use App\Mail\TemplateMail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;

class EmailTemplateService
{
    public function extractPlaceholders(string ...$contents): array
    {
        $found = [];

        foreach ($contents as $content) {
            if (preg_match_all('/\{\{\s*([a-zA-Z0-9_]+)\s*\}\}/', $content, $matches)) {
                foreach ($matches[1] as $placeholder) {
                    $found[$placeholder] = true;
                }
            }
        }

        return array_keys($found);
    }

    public function render(string $content, array $variables): string
    {
        $rendered = $content;

        foreach ($variables as $key => $value) {
            $escaped = e((string) $value);
            $rendered = str_replace(
                ['{{'.$key.'}}', '{{ '.$key.' }}', '{{'.$key.' }}', '{{ '.$key.'}}'],
                $escaped,
                $rendered
            );
        }

        return $rendered;
    }

    public function renderTemplate(EmailTemplate $template, array $variables): array
    {
        return [
            'subject' => $this->render($template->subject, $variables),
            'body' => $this->render($template->body, $variables),
        ];
    }

    public function send(
        EmailTemplate $template,
        string $toEmail,
        array $variables,
        ?string $toName = null,
        ?string $cc = null,
    ): void {
        app(MailSettingsService::class)->applyToConfig();

        $rendered = $this->renderTemplate($template, $variables);

        $mail = Mail::to($toEmail, $toName ?: null);

        if ($cc) {
            $mail->cc(array_map('trim', explode(',', $cc)));
        }

        $mail->send(new TemplateMail($rendered['subject'], $rendered['body']));
    }

    public function placeholderLabels(): array
    {
        return [
            'customer_name' => 'Customer name',
            'sender_name' => 'Sender name',
            'project_type' => 'Project type',
            'message' => 'Message / notes',
            'phone' => 'Phone number',
            'address' => 'Address',
            'appointment_date' => 'Appointment date',
            'company_name' => 'Company name',
        ];
    }

    public function labelForPlaceholder(string $placeholder): string
    {
        return $this->placeholderLabels()[$placeholder]
            ?? str($placeholder)->replace('_', ' ')->title()->toString();
    }

    public function formatPlaceholderTag(string $key): string
    {
        return '{{'.$key.'}}';
    }

    public function formatPlaceholderList(array $placeholders): string
    {
        return implode(', ', array_map($this->formatPlaceholderTag(...), $placeholders));
    }

    public function samplePreviewVariables(): array
    {
        return [
            'customer_name' => 'John Smith',
            'sender_name' => auth()->user()?->name ?? 'Creative Granite Team',
            'project_type' => 'Kitchen Countertops',
            'message' => 'We would love to help you select the perfect stone for your project. Let us know if you have any questions.',
            'phone' => '801-574-5477',
            'address' => '1998 N Redwood Rd, Salt Lake City, UT 84116',
            'appointment_date' => 'Monday, July 12 at 10:00 AM',
            'company_name' => 'Creative Granite & Design',
        ];
    }
}
