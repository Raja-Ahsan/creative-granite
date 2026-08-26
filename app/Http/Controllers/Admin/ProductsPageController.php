<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsPageController extends Controller
{
    private const KEYS = [
        'products_page_eyebrow',
        'products_page_heading',
        'products_page_subheading',
    ];

    public function edit(): View
    {
        return view('screens.admin.products-page.edit', [
            'values' => $this->settingValues(),
            'title' => 'Products Page Settings',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'products_page_eyebrow' => ['nullable', 'string', 'max:120'],
            'products_page_heading' => ['nullable', 'string', 'max:255'],
            'products_page_subheading' => ['nullable', 'string', 'max:5000'],
        ]);

        foreach (self::KEYS as $key) {
            if (array_key_exists($key, $data)) {
                $this->saveSetting($key, (string) ($data[$key] ?? ''));
            }
        }

        return redirect()->route('admin.products-page.edit')->with('success', 'Products page settings updated.');
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
            'products_page_eyebrow' => 'Products',
            'products_page_heading' => 'CGD ESI Sink Collection',
            'products_page_subheading' => 'Explore stainless steel, porcelain, fireclay, and quartz composite sinks with full specifications for every model.',
        ];
    }

    private function saveSetting(string $key, string $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => 'string', 'group' => 'products_page']
        );
    }
}
