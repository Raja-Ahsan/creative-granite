<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    private const SETTING_KEYS = [
        'logo_path',
        'footer_logo_path',
        'favicon_path',
        'footer_copyright',
    ];

    public function edit(): View
    {
        return view('screens.admin.site-settings.edit', [
            'values' => $this->settingValues(),
            'title' => 'Site Settings',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'footer_copyright' => ['nullable', 'string', 'max:500'],
            'logo' => ['nullable', 'image', 'max:10240'],
            'footer_logo' => ['nullable', 'image', 'max:10240'],
            'favicon' => ['nullable', 'file', 'mimes:png,jpg,jpeg,gif,webp,ico', 'max:2048'],
        ]);

        if ($path = $this->storeUploadedFile($request, 'logo')) {
            $this->saveSetting('logo_path', $path, 'image');
        }

        if ($path = $this->storeUploadedFile($request, 'footer_logo')) {
            $this->saveSetting('footer_logo_path', $path, 'image');
        }

        if ($path = $this->storeUploadedFile($request, 'favicon')) {
            $this->saveSetting('favicon_path', $path, 'image');
        }

        if ($request->has('footer_copyright')) {
            $this->saveSetting(
                'footer_copyright',
                $request->input('footer_copyright', ''),
                'string',
                'general'
            );
        }

        return redirect()->route('admin.site-settings.edit')->with('success', 'Site settings updated.');
    }

    private function settingValues(): array
    {
        $defaults = [
            'logo_path' => '/images/site/update-logo.png',
            'footer_logo_path' => '/images/site/update-logo.png',
            'favicon_path' => '/favicon.ico',
            'footer_copyright' => '© '.date('Y').' Creative granite & design. All rights reserved.',
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SETTING_KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }

    private function saveSetting(string $key, string $value, string $type, string $group = 'assets'): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
    }

    private function storeUploadedFile(Request $request, string $input): ?string
    {
        if (! $request->hasFile($input)) {
            return null;
        }

        $path = $request->file($input)->store('site', 'public');

        return '/storage/'.$path;
    }
}
