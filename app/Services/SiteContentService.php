<?php

namespace App\Services;

use App\Models\HeroSlide;
use App\Models\Material;
use App\Models\PortfolioItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProjectType;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteContentService
{
    public const CACHE_KEY = 'site.content.payload';

    public function getPayload(): array
    {
        return Cache::remember(self::CACHE_KEY, now()->addDay(), fn () => $this->buildPayload());
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    private function buildPayload(): array
    {
        $settings = SiteSetting::query()
            ->pluck('value', 'key')
            ->all();

        return [
            'settings' => [
                'logo' => $settings['logo_path'] ?? '/images/site/update-logo.png',
                'aboutStoneBath' => $settings['about_image_path'] ?? '/images/site/LakeLine-20.jpg',
                'instagramUrl' => $settings['instagram_url'] ?? '#',
                'showroomMapsUrl' => $settings['showroom_maps_url'] ?? '',
                'addressLine1' => $settings['address_line_1'] ?? '',
                'addressLine2' => $settings['address_line_2'] ?? '',
                'phone' => $settings['phone'] ?? '',
                'email' => $settings['email'] ?? '',
                'hours' => $settings['hours'] ?? '',
                'foundedYear' => $settings['founded_year'] ?? '1998',
                'footerTagline' => $settings['footer_tagline'] ?? '',
                'contactFormIntro' => $settings['contact_form_intro'] ?? 'Tell us about your project — we will follow up with next steps, timing, and a path to estimate.',
            ],
            'projectTypes' => ProjectType::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (ProjectType $type) => [
                    'value' => $type->slug,
                    'label' => $type->name,
                ])
                ->values()
                ->all(),
            'heroSlides' => HeroSlide::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (HeroSlide $slide) => [
                    'src' => $slide->image_path,
                    'alt' => $slide->alt_text,
                ])
                ->values()
                ->all(),
            'portfolio' => PortfolioItem::query()
                ->orderBy('id')
                ->get()
                ->map(fn (PortfolioItem $item) => [
                    'src' => $item->image_path,
                    'title' => $item->title,
                    'tag' => '',
                ])
                ->values()
                ->all(),
            'instagramPosts' => $this->staticInstagramPosts(),
            'materials' => Material::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Material $material) => [
                    'name' => $material->name,
                    'desc' => $material->description,
                    'image' => $material->image_path,
                ])
                ->values()
                ->all(),
            'products' => Product::query()
                ->with(['images' => fn ($query) => $query->orderBy('sort_order')])
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Product $product) => [
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'desc' => $product->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($product->description), 160),
                    'description' => $product->description,
                    'image' => $product->image_path,
                    'relatedImages' => $product->images
                        ->map(fn (ProductImage $image) => [
                            'src' => $image->image_path,
                            'alt' => $image->alt_text ?: $product->name,
                        ])
                        ->values()
                        ->all(),
                ])
                ->values()
                ->all(),
            'services' => Service::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Service $service) => [
                    'title' => $service->title,
                    'slug' => $service->slug,
                    'excerpt' => $service->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($service->body), 220),
                    'body' => $service->body,
                    'mainImage' => $service->main_image_path,
                ])
                ->values()
                ->all(),
            'processSteps' => ProcessStep::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (ProcessStep $step) => [
                    'n' => $step->step_number,
                    't' => $step->title,
                    'd' => $step->description,
                ])
                ->values()
                ->all(),
            'testimonials' => $this->staticTestimonials(),
            'navLeft' => $this->staticNavLeft(),
            'navRight' => $this->staticNavRight(),
            'footerNavLinks' => $this->staticFooterNavLinks(),
            'footerSocialLinks' => $this->staticFooterSocialLinks(),
            'sections' => $this->staticSections(),
        ];
    }

    private function staticInstagramPosts(): array
    {
        $files = [
            'DSC_3969.jpg',
            'DSC_3986 (1).jpg',
            'DSC_4008.jpg',
            'DSC_4011.jpg',
            'DSC_4068.jpg',
            'DSC_4165.jpg',
            'DSC_4181 (1).jpg',
            'DSC_4192.jpg',
            'DSC_4204 (1).jpg',
            'Journeys End-12.jpg',
            'LakeLine-20.jpg',
            'Sabal-24.jpg',
        ];

        return array_map(function (string $file) {
            $label = pathinfo($file, PATHINFO_FILENAME);

            return [
                'src' => '/portfolio/instagram/'.rawurlencode($file),
                'alt' => 'Creative Granite stone fabrication — '.$label,
                'url' => '#',
            ];
        }, $files);
    }

    private function staticTestimonials(): array
    {
        return [
            ['q' => "We've used them on three builds now. Consistent quality, great communication, and they always hit our timelines. Wouldn't go anywhere else.", 'a' => 'Mark T.', 'r' => 'General contractor'],
            ['q' => 'Their slab selection process is the most thoughtful in utah. The install crew left the space cleaner than they found it.', 'a' => 'Lauren P.', 'r' => 'Interior designer'],
            ['q' => 'Countless multifamily projects, zero late deliveries. Creative is the partner you call when it has to be right.', 'a' => 'David R.', 'r' => 'Developer'],
        ];
    }

    private function staticNavLeft(): array
    {
        return [
            ['Work', '/#work'],
            ['Products', '/products'],
            ['Services', '/services'],
        ];
    }

    private function staticNavRight(): array
    {
        return [
            ['Process', '/process'],
            ['Get an estimate', '#estimate'],
        ];
    }

    private function staticFooterNavLinks(): array
    {
        return [
            ['Work', '/#work'],
            ['Products', '/products'],
            ['Services', '/services'],
            ['Process', '/process'],
            ['Get an Estimate', '#estimate'],
        ];
    }

    private function staticFooterSocialLinks(): array
    {
        return [
            ['label' => 'Instagram', 'url' => '#'],
            ['label' => 'Facebook', 'url' => '#'],
            ['label' => 'LinkedIn', 'url' => '#'],
        ];
    }

    private function staticSections(): array
    {
        $sections = [
            'hero-intro' => [
                'eyebrow' => 'Welcome to creative granite and design',
                'heading' => 'Crafting Custom Stone for Inspired Spaces',
                'subheading' => 'Serving homeowners, builders, and multifamily projects across Utah',
                'body' => 'Premium granite, quartz, marble and quartzite. Hand fabricated in Utah for builders, designers and homeowners who care about the details no one is supposed to notice.',
                'highlightText' => '',
                'image' => '',
            ],
            'who-we-are' => [
                'eyebrow' => 'Who we are',
                'heading' => 'Built on craftsmanship since',
                'subheading' => '',
                'body' => 'Creative Granite  Design is a Utah based stone fabrication company specializing in custom countertops and architectural surfaces. We partner with homeowners, builders, and designers to deliver precise fabrication, thoughtful material selection, and high quality installation across residential and multifamily residential projects in Utah, Idaho, and Wyoming.',
                'highlightText' => '1998',
                'image' => '/images/site/LakeLine-20.jpg',
            ],
            'materials' => [
                'eyebrow' => 'Materials',
                'heading' => 'The slab decides everything.',
                'subheading' => 'Four core surfaces, each with its own temperament. We help you choose by feel, not just by sample.',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'products' => [
                'eyebrow' => 'Products',
                'heading' => 'Stone surfaces for every space.',
                'subheading' => 'From kitchen countertops to bathroom vanities and fireplace surrounds — explore our full range of custom stone products.',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'work' => [
                'eyebrow' => 'Our work',
                'heading' => 'Fabricated with precision, installed with intention.',
                'subheading' => 'A selection of completed spaces, material details, and in between moments each reflecting our approach to stone, design, and execution.',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'instagram' => [
                'eyebrow' => 'Instagram',
                'heading' => 'Follow our work.',
                'subheading' => 'Behind the scenes, slab selections, and finished installs see what we are working on in the shop and in the field.',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'services' => [
                'eyebrow' => 'Services',
                'heading' => 'Built for builders. Tailored for homes.',
                'subheading' => 'From new construction to remodels and multifamily projects — precision fabrication and installation across Utah.',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'process' => [
                'eyebrow' => 'Project timeline',
                'heading' => 'Four steps, no surprises.',
                'subheading' => '',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'remnants' => [
                'eyebrow' => 'Remnants',
                'heading' => 'Great stone at a great value.',
                'subheading' => '',
                'body' => 'Smaller pieces of stone, ideal for vanities, laundry rooms, and smaller projects. First come, first served — join our list for early access.',
                'highlightText' => '',
                'image' => '/portfolio/Creative-Quartz-scaled-1.jpg',
            ],
            'testimonial' => [
                'eyebrow' => '',
                'heading' => 'Trusted across utah.',
                'subheading' => '',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'cta' => [
                'eyebrow' => 'Start your project',
                'heading' => 'Start your project',
                'subheading' => '',
                'body' => 'Whether you’re building a custom home, planning a remodel, or managing a multifamily or commercial project, our team is here to help bring it to life.',
                'highlightText' => '',
                'image' => '',
            ],
        ];

        return $sections;
    }
}
