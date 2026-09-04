<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterialsPageController extends Controller
{
    private const KEYS = [
        'materials_section_eyebrow',
        'materials_section_heading',
        'materials_section_subheading',
        'materials_products_eyebrow',
        'materials_products_heading',
        'materials_products_subheading',
        'materials_callout_eyebrow',
        'materials_callout_heading',
        'materials_callout_body',
        'materials_callout_button_label',
        'materials_callout_button_url',
    ];

    public function edit(): View
    {
        return view('screens.admin.materials-page.edit', [
            'values' => $this->settingValues(),
            'title' => 'Materials Section Settings',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'materials_section_eyebrow' => ['nullable', 'string', 'max:120'],
            'materials_section_heading' => ['nullable', 'string', 'max:255'],
            'materials_section_subheading' => ['nullable', 'string', 'max:5000'],
            'materials_products_eyebrow' => ['nullable', 'string', 'max:120'],
            'materials_products_heading' => ['nullable', 'string', 'max:255'],
            'materials_products_subheading' => ['nullable', 'string', 'max:5000'],
            'materials_callout_eyebrow' => ['nullable', 'string', 'max:120'],
            'materials_callout_heading' => ['nullable', 'string', 'max:255'],
            'materials_callout_body' => ['nullable', 'string', 'max:5000'],
            'materials_callout_button_label' => ['nullable', 'string', 'max:120'],
            'materials_callout_button_url' => ['nullable', 'string', 'max:500'],
        ]);

        foreach (self::KEYS as $key) {
            if (array_key_exists($key, $data)) {
                $this->saveSetting($key, (string) ($data[$key] ?? ''));
            }
        }

        return redirect()->route('admin.materials-page.edit')->with('success', 'Materials section settings updated.');
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
            'materials_section_eyebrow' => 'Materials',
            'materials_section_heading' => 'The slab decides everything.',
            'materials_section_subheading' => 'Explore our most requested natural and engineered surfaces. Each offers its own balance of character, durability, and performance. Additional materials are available upon request.',
            'materials_products_eyebrow' => 'Materials',
            'materials_products_heading' => 'Explore Our Materials',
            'materials_products_subheading' => 'Explore our most requested natural and engineered surfaces. Each offers its own balance of character, durability, and performance.',
            'materials_callout_eyebrow' => 'Additional Materials',
            'materials_callout_heading' => 'Beyond the Core Collection',
            'materials_callout_body' => 'Creative Granite + Design also works with porcelain and can special order additional surface materials based on the needs of the project. If a client is looking for a specific material or application, our team can help explore available options.',
            'materials_callout_button_label' => 'Contact Us',
            'materials_callout_button_url' => '/contact',
        ];
    }

    private function saveSetting(string $key, string $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => 'string', 'group' => 'materials_section']
        );
    }
}
