<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WhoWeAreController extends Controller
{
    private const SETTING_KEYS = [
        'who_we_are_eyebrow',
        'who_we_are_heading',
        'who_we_are_highlight_text',
        'who_we_are_body',
        'about_image_path',
    ];

    public function edit(): View
    {
        return view('screens.admin.who-we-are.edit', [
            'values' => $this->settingValues(),
            'title' => 'Who We Are',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'who_we_are_eyebrow' => ['nullable', 'string', 'max:120'],
            'who_we_are_heading' => ['nullable', 'string', 'max:255'],
            'who_we_are_highlight_text' => ['nullable', 'string', 'max:40'],
            'who_we_are_body' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'max:10240'],
        ]);

        foreach ([
            'who_we_are_eyebrow',
            'who_we_are_heading',
            'who_we_are_highlight_text',
            'who_we_are_body',
        ] as $key) {
            $this->saveSetting($key, $data[$key] ?? '', 'string');
        }

        // Keep founded_year in sync with the year highlight shown on the homepage.
        if (array_key_exists('who_we_are_highlight_text', $data)) {
            $this->saveSetting('founded_year', $data['who_we_are_highlight_text'] ?? '', 'string', 'general');
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('site', 'public');
            $this->saveSetting('about_image_path', '/storage/'.$path, 'image', 'assets');
        }

        return redirect()->route('admin.who-we-are.edit')->with('success', 'Who We Are section updated.');
    }

    private function settingValues(): array
    {
        $defaults = [
            'who_we_are_eyebrow' => 'Who we are',
            'who_we_are_heading' => 'Built on craftsmanship since',
            'who_we_are_highlight_text' => '1998',
            'who_we_are_body' => 'Creative Granite + Design is a Utah-based stone fabrication company specializing in custom countertops and architectural surfaces. We partner with homeowners, builders, and designers to deliver precise fabrication, thoughtful material selection, and high-quality installation across residential and multifamily projects.',
            'about_image_path' => '/images/site/LakeLine-20.jpg',
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SETTING_KEYS)
            ->pluck('value', 'key')
            ->all();

        // Prefer founded_year if highlight text has never been saved separately.
        if (! isset($stored['who_we_are_highlight_text'])) {
            $founded = SiteSetting::query()->where('key', 'founded_year')->value('value');
            if (filled($founded)) {
                $stored['who_we_are_highlight_text'] = $founded;
            }
        }

        return array_merge($defaults, $stored);
    }

    private function saveSetting(string $key, string $value, string $type, string $group = 'who_we_are'): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );
    }
}
