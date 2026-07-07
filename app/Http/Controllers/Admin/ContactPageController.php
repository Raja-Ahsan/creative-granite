<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectType;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactPageController extends Controller
{
    private const SETTING_KEYS = [
        'address_line_1',
        'address_line_2',
        'hours',
        'phone',
        'email',
        'showroom_maps_url',
        'contact_form_intro',
    ];

    public function edit(): View
    {
        return view('screens.admin.contact-page.edit', [
            'values' => $this->settingValues(),
            'projectTypes' => ProjectType::query()->orderBy('sort_order')->get(),
            'title' => 'Contact Page',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'address_line_1' => ['nullable', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'hours' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'showroom_maps_url' => ['nullable', 'url', 'max:500'],
            'contact_form_intro' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($data as $key => $value) {
            $this->saveSetting($key, $value ?? '');
        }

        return redirect()->route('admin.contact-page.edit')->with('success', 'Contact page updated.');
    }

    private function settingValues(): array
    {
        $defaults = [
            'address_line_1' => '',
            'address_line_2' => '',
            'hours' => '',
            'phone' => '',
            'email' => '',
            'showroom_maps_url' => '',
            'contact_form_intro' => 'Tell us about your project — we will follow up with next steps, timing, and a path to estimate.',
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SETTING_KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }

    private function saveSetting(string $key, string $value): void
    {
        $groups = [
            'address_line_1' => 'contact',
            'address_line_2' => 'contact',
            'hours' => 'contact',
            'phone' => 'contact',
            'email' => 'contact',
            'showroom_maps_url' => 'contact',
            'contact_form_intro' => 'contact',
        ];

        $types = [
            'email' => 'email',
            'phone' => 'phone',
            'showroom_maps_url' => 'url',
        ];

        SiteSetting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $types[$key] ?? 'string',
                'group' => $groups[$key] ?? 'general',
            ]
        );
    }
}
