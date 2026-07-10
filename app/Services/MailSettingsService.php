<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;

class MailSettingsService
{
    public const GROUP = 'mail';

    public const KEYS = [
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_encryption',
        'mail_username',
        'mail_password',
        'mail_from_address',
        'mail_from_name',
        'mail_contact_recipient',
    ];

    public function defaults(): array
    {
        return [
            'mail_mailer' => env('MAIL_MAILER', 'smtp'),
            'mail_host' => env('MAIL_HOST', '127.0.0.1'),
            'mail_port' => (string) env('MAIL_PORT', 587),
            'mail_encryption' => env('MAIL_ENCRYPTION', 'tls') ?: '',
            'mail_username' => env('MAIL_USERNAME', ''),
            'mail_password' => env('MAIL_PASSWORD', ''),
            'mail_from_address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
            'mail_from_name' => env('MAIL_FROM_NAME', config('app.name', 'Creative Granite')),
            'mail_contact_recipient' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        ];
    }

    public function getSettings(): array
    {
        $defaults = $this->defaults();

        if (! Schema::hasTable('site_settings')) {
            return $defaults;
        }

        $stored = SiteSetting::query()
            ->whereIn('key', self::KEYS)
            ->pluck('value', 'key')
            ->all();

        $settings = array_merge($defaults, $stored);

        if (! empty($stored['mail_password'])) {
            try {
                $settings['mail_password'] = Crypt::decryptString($stored['mail_password']);
            } catch (\Throwable) {
                $settings['mail_password'] = '';
            }
        }

        if (empty($settings['mail_contact_recipient'])) {
            $settings['mail_contact_recipient'] = SiteSetting::getValue('email', $defaults['mail_contact_recipient']);
        }

        return $settings;
    }

    public function getFormValues(): array
    {
        $settings = $this->getSettings();

        return [
            'mail_mailer' => $settings['mail_mailer'],
            'mail_host' => $settings['mail_host'],
            'mail_port' => $settings['mail_port'],
            'mail_encryption' => $settings['mail_encryption'],
            'mail_username' => $settings['mail_username'],
            'mail_from_address' => $settings['mail_from_address'],
            'mail_from_name' => $settings['mail_from_name'],
            'mail_contact_recipient' => $settings['mail_contact_recipient'],
            'has_saved_password' => $this->hasStoredPassword(),
        ];
    }

    public function hasDatabaseConfiguration(): bool
    {
        if (! Schema::hasTable('site_settings')) {
            return false;
        }

        return SiteSetting::query()->where('key', 'mail_mailer')->exists();
    }

    public function hasStoredPassword(): bool
    {
        if (! Schema::hasTable('site_settings')) {
            return false;
        }

        return filled(SiteSetting::query()->where('key', 'mail_password')->value('value'));
    }

    public function save(array $data): void
    {
        $this->saveSetting('mail_mailer', $data['mail_mailer']);
        $this->saveSetting('mail_host', $data['mail_host'] ?? '');
        $this->saveSetting('mail_port', (string) ($data['mail_port'] ?? ''));
        $this->saveSetting('mail_encryption', $data['mail_encryption'] ?? '');
        $this->saveSetting('mail_username', $data['mail_username'] ?? '');
        $this->saveSetting('mail_from_address', $data['mail_from_address']);
        $this->saveSetting('mail_from_name', $data['mail_from_name']);
        $this->saveSetting('mail_contact_recipient', $data['mail_contact_recipient']);

        SiteSetting::updateOrCreate(
            ['key' => 'email'],
            ['value' => $data['mail_contact_recipient'], 'type' => 'email', 'group' => 'contact']
        );

        if (filled($data['mail_password'] ?? null)) {
            $this->saveSetting('mail_password', Crypt::encryptString($data['mail_password']));
        }

        $this->applyToConfig();
    }

    public function applyToConfig(): void
    {
        if (! $this->hasDatabaseConfiguration()) {
            return;
        }

        $settings = $this->getSettings();
        $encryption = $settings['mail_encryption'] ?: null;

        config([
            'mail.default' => $settings['mail_mailer'] ?: 'smtp',
            'mail.mailers.smtp.transport' => 'smtp',
            'mail.mailers.smtp.host' => $settings['mail_host'],
            'mail.mailers.smtp.port' => (int) $settings['mail_port'],
            'mail.mailers.smtp.encryption' => $encryption,
            'mail.mailers.smtp.username' => $settings['mail_username'] ?: null,
            'mail.mailers.smtp.password' => $settings['mail_password'] ?: null,
            'mail.from.address' => $settings['mail_from_address'],
            'mail.from.name' => $settings['mail_from_name'],
        ]);
    }

    public function contactRecipient(): string
    {
        $settings = $this->getSettings();

        return $settings['mail_contact_recipient']
            ?: SiteSetting::getValue('email')
            ?: config('mail.from.address');
    }

    private function saveSetting(string $key, string $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => 'string', 'group' => self::GROUP]
        );
    }
}
