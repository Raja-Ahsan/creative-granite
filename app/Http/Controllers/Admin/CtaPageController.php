<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\SiteContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CtaPageController extends Controller
{
    private const KEYS = [
        'cta_eyebrow',
        'cta_heading',
        'cta_body',
        'cta_button_label',
        'cta_button_url',
        'cta_showroom_label',
        'cta_appointment_label',
        'cta_appointment_url',
    ];

    public function edit(): View
    {
        return view('screens.admin.cta-page.edit', [
            'values' => $this->settingValues(),
            'title' => 'Final CTA Section',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'cta_eyebrow' => ['nullable', 'string', 'max:120'],
            'cta_heading' => ['nullable', 'string', 'max:255'],
            'cta_body' => ['nullable', 'string', 'max:2000'],
            'cta_button_label' => ['nullable', 'string', 'max:120'],
            'cta_button_url' => ['nullable', 'string', 'max:500'],
            'cta_showroom_label' => ['nullable', 'string', 'max:120'],
            'cta_appointment_label' => ['nullable', 'string', 'max:120'],
            'cta_appointment_url' => ['nullable', 'string', 'max:500'],
        ]);

        foreach (self::KEYS as $key) {
            $this->saveSetting($key, (string) ($data[$key] ?? ''));
        }

        SiteContentService::clearCache();

        return redirect()
            ->route('admin.cta-page.edit')
            ->with('success', 'CTA section updated.');
    }

    private function settingValues(): array
    {
        $defaults = $this->defaults();
        $stored = SiteSetting::query()
            ->whereIn('key', self::KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }

    private function defaults(): array
    {
        return [
            'cta_eyebrow' => 'Final Call to Action',
            'cta_heading' => 'Start your project',
            'cta_body' => "Whether you're building a custom home, planning a remodel, or managing a multifamily or commercial project, our team is here to help bring it to life.",
            'cta_button_label' => 'Get an Estimate',
            'cta_button_url' => '#estimate',
            'cta_showroom_label' => 'Visit our showroom',
            'cta_appointment_label' => 'Or book an appointment',
            'cta_appointment_url' => '/contact',
        ];
    }

    private function saveSetting(string $key, string $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => 'string', 'group' => 'cta']
        );
    }
}
