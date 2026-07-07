<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MailSettingsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class EmailSettingController extends Controller
{
    public function __construct(private MailSettingsService $mailSettings) {}

    public function edit(): View
    {
        return view('screens.admin.email-settings.edit', [
            'values' => $this->mailSettings->getFormValues(),
            'usingDatabase' => $this->mailSettings->hasDatabaseConfiguration(),
            'title' => 'Email Settings',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'mail_mailer' => ['required', 'in:smtp,log,sendmail'],
            'mail_host' => ['required_if:mail_mailer,smtp', 'nullable', 'string', 'max:255'],
            'mail_port' => ['required_if:mail_mailer,smtp', 'nullable', 'integer', 'min:1', 'max:65535'],
            'mail_encryption' => ['nullable', 'string', 'in:tls,ssl'],
            'mail_username' => ['nullable', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_from_address' => ['required', 'email', 'max:255'],
            'mail_from_name' => ['required', 'string', 'max:255'],
            'mail_contact_recipient' => ['required', 'email', 'max:255'],
        ]);

        $this->mailSettings->save($validated);

        return redirect()
            ->route('admin.email-settings.edit')
            ->with('success', 'Email settings saved successfully.');
    }

    public function sendTest(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'test_email' => ['required', 'email', 'max:255'],
        ]);

        $this->mailSettings->applyToConfig();

        try {
            Mail::raw(
                'This is a test email from Creative Granite admin. Your SMTP settings are working correctly.',
                function ($message) use ($validated) {
                    $message->to($validated['test_email'])
                        ->subject('Creative Granite — Test Email');
                }
            );
        } catch (\Throwable $exception) {
            return redirect()
                ->route('admin.email-settings.edit')
                ->with('error', 'Test email failed: '.$exception->getMessage());
        }

        return redirect()
            ->route('admin.email-settings.edit')
            ->with('success', 'Test email sent to '.$validated['test_email'].'.');
    }
}
