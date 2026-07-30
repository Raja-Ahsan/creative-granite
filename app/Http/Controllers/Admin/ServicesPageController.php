<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServicesPageController extends Controller
{
    use HandlesImageUpload;

    private const KEYS = [
        'services_page_eyebrow',
        'services_page_heading',
        'services_page_body',
        'services_page_hero_path',
        'services_page_repairs_number',
        'services_page_repairs_eyebrow',
        'services_page_repairs_heading',
        'services_page_repairs_body',
        'services_page_repairs_image_path',
        'services_page_warranty_title',
        'services_page_warranty_points',
        'services_page_warranty_cta',
        'services_page_repairs_card_title',
        'services_page_repairs_points',
        'services_page_repairs_cta',
        'services_page_cta_heading',
        'services_page_cta_body',
        'services_page_cta_button',
    ];

    public function edit(): View
    {
        return view('screens.admin.services-page.edit', [
            'values' => $this->settingValues(),
            'title' => 'Services Page Settings',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'services_page_eyebrow' => ['nullable', 'string', 'max:120'],
            'services_page_heading' => ['nullable', 'string', 'max:255'],
            'services_page_body' => ['nullable', 'string', 'max:5000'],
            'services_page_repairs_number' => ['nullable', 'string', 'max:10'],
            'services_page_repairs_eyebrow' => ['nullable', 'string', 'max:120'],
            'services_page_repairs_heading' => ['nullable', 'string', 'max:255'],
            'services_page_repairs_body' => ['nullable', 'string', 'max:5000'],
            'services_page_warranty_title' => ['nullable', 'string', 'max:120'],
            'services_page_warranty_points' => ['nullable', 'string', 'max:5000'],
            'services_page_warranty_cta' => ['nullable', 'string', 'max:120'],
            'services_page_repairs_card_title' => ['nullable', 'string', 'max:120'],
            'services_page_repairs_points' => ['nullable', 'string', 'max:5000'],
            'services_page_repairs_cta' => ['nullable', 'string', 'max:120'],
            'services_page_cta_heading' => ['nullable', 'string', 'max:255'],
            'services_page_cta_body' => ['nullable', 'string', 'max:5000'],
            'services_page_cta_button' => ['nullable', 'string', 'max:120'],
            'hero_image' => ['nullable', 'image', 'max:12288'],
            'repairs_image' => ['nullable', 'image', 'max:12288'],
        ]);

        foreach (self::KEYS as $key) {
            if (in_array($key, ['services_page_hero_path', 'services_page_repairs_image_path'], true)) {
                continue;
            }
            if (array_key_exists($key, $data)) {
                $this->saveSetting($key, (string) ($data[$key] ?? ''));
            }
        }

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('services-page', 'public');
            $this->saveSetting('services_page_hero_path', '/storage/'.$path, 'image');
        }

        if ($request->hasFile('repairs_image')) {
            $path = $request->file('repairs_image')->store('services-page', 'public');
            $this->saveSetting('services_page_repairs_image_path', '/storage/'.$path, 'image');
        }

        return redirect()->route('admin.services-page.edit')->with('success', 'Services page settings updated.');
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
            'services_page_eyebrow' => 'Services',
            'services_page_heading' => 'Stone Fabrication for Every Stage of Your Project.',
            'services_page_body' => 'From custom homes and remodels to multifamily and commercial spaces, we fabricate, install, and support premium stone surfaces built to last.',
            'services_page_hero_path' => '/images/services/hero.png',
            'services_page_repairs_number' => '04',
            'services_page_repairs_eyebrow' => 'Repairs & Warranty',
            'services_page_repairs_heading' => 'Stand Behind Every Installation',
            'services_page_repairs_body' => "Our commitment doesn't end after installation. We provide warranty support for qualifying workmanship and offer repair services to help keep your stone surfaces looking their best.",
            'services_page_repairs_image_path' => '/images/services/repairs-hero-voyager.png',
            'services_page_warranty_title' => 'Warranty',
            'services_page_warranty_points' => "One-year workmanship warranty\nWarranty support for qualifying fabrication and installation issues\nDedicated service team",
            'services_page_warranty_cta' => 'Request a Warranty Repair.',
            'services_page_repairs_card_title' => 'Repairs',
            'services_page_repairs_points' => "Repair services available by request\nContact us for an evaluation and quote",
            'services_page_repairs_cta' => 'Request a Repair Estimate',
            'services_page_cta_heading' => 'Ready to Start Your Project?',
            'services_page_cta_body' => "Whether you're building a custom home, remodeling an existing space, or managing a multifamily or commercial project, our team is ready to bring your vision to life.",
            'services_page_cta_button' => 'Get an Estimate',
        ];
    }

    private function saveSetting(string $key, string $value, string $type = 'string'): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => 'services_page']
        );
    }
}
