<?php

namespace App\Services;

use App\Models\HeroSlide;
use App\Models\Material;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\SiteSetting;

class SiteContentService
{
    public function getPayload(): array
    {
        $settings = SiteSetting::query()
            ->pluck('value', 'key')
            ->all();

        return [
            'settings' => [
                'logo' => $settings['logo_path'] ?? '/images/site/update-logo.png',
                'aboutStoneBath' => $settings['about_image_path'] ?? '/images/site/LakeLine-20.jpeg',
                'instagramUrl' => $settings['instagram_url'] ?? '#',
                'showroomMapsUrl' => $settings['showroom_maps_url'] ?? '',
                'addressLine1' => $settings['address_line_1'] ?? '',
                'addressLine2' => $settings['address_line_2'] ?? '',
                'phone' => $settings['phone'] ?? '',
                'email' => $settings['email'] ?? '',
                'hours' => $settings['hours'] ?? '',
                'foundedYear' => $settings['founded_year'] ?? '1998',
                'footerTagline' => $settings['footer_tagline'] ?? '',
            ],
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
            'services' => Service::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Service $service) => [
                    'title' => $service->title,
                    'body' => $service->body,
                ])
                ->values()
                ->all(),
            'processSteps' => $this->staticProcessSteps(),
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
        return [
            ['src' => '/portfolio/DSC_4076.jpg', 'alt' => 'Marble kitchen countertop installation in Park City', 'url' => '#'],
            ['src' => '/portfolio/DSC_3988.jpg', 'alt' => 'Quartzite kitchen surfaces in Holladay', 'url' => '#'],
            ['src' => '/portfolio/054.jpg', 'alt' => 'Custom stone island fabrication', 'url' => '#'],
            ['src' => '/portfolio/063.jpg', 'alt' => 'Granite countertop detail', 'url' => '#'],
            ['src' => '/portfolio/073.jpg', 'alt' => 'Modern bathroom stone vanity', 'url' => '#'],
            ['src' => '/portfolio/040-1.jpg', 'alt' => 'Creative Granite showroom slab selection', 'url' => '#'],
        ];
    }

    private function staticProcessSteps(): array
    {
        return [
            ['n' => '01', 't' => 'Initial Consultation', 'd' => 'We discuss your project, timeline, and budget in our showroom or on-site.'],
            ['n' => '02', 't' => 'Estimate & Material Selection', 'd' => 'We provide a detailed quote and guide you through slab selection from our inventory.'],
            ['n' => '03', 't' => 'Template & Measurement', 'd' => 'Our team templates your space with precision for a perfect fit no guesswork.'],
            ['n' => '04', 't' => 'Fabrication & Install', 'd' => 'Hand finished edges, sealed surfaces, and a clean, on schedule installation.'],
        ];
    }

    private function staticTestimonials(): array
    {
        return [
            ['q' => "We've used them on three builds now. Consistent quality, great communication, and they always hit our timelines. Wouldn't go anywhere else.", 'a' => 'Mark T.', 'r' => 'General contractor'],
            ['q' => 'Their slab selection process is the most thoughtful in utah. The install crew left the space cleaner than they found it.', 'a' => 'Lauren P.', 'r' => 'Interior designer'],
            ['q' => 'Multifamily project, 120 units, zero late deliveries. Creative is the partner you call when it has to be right.', 'a' => 'David R.', 'r' => 'Developer'],
        ];
    }

    private function staticNavLeft(): array
    {
        return [
            ['Work', '#work'],
            ['Products', '#products'],
            ['Services', '#services'],
        ];
    }

    private function staticNavRight(): array
    {
        return [
            ['Process', '#process'],
            ['Contact', '#contact'],
        ];
    }

    private function staticFooterNavLinks(): array
    {
        return ['Work', 'Products', 'Services', 'Process', 'Get an Estimate'];
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
                'body' => 'Creative Granite + Design is a Utah based stone fabrication company specializing in custom countertops and architectural surfaces. We partner with homeowners, builders, and designers to deliver precise fabrication, thoughtful material selection, and high quality installation across residential and multifamily residential projects in Utah, Idaho, and Wyoming.',
                'highlightText' => '1998',
                'image' => '/images/site/LakeLine-20.jpeg',
            ],
            'materials' => [
                'eyebrow' => 'Materials',
                'heading' => 'The slab decides everything.',
                'subheading' => 'Four core surfaces, each with its own temperament. We help you choose by feel, not just by sample.',
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
                'subheading' => '',
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
                'eyebrow' => 'Trusted across utah',
                'heading' => '',
                'subheading' => '',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'cta' => [
                'eyebrow' => 'Start your project',
                'heading' => 'Start your project.',
                'subheading' => '',
                'body' => 'Whether you’re building a custom home, planning a remodel, or managing a multifamily or commercial project, our team is here to help bring it to life.',
                'highlightText' => '',
                'image' => '',
            ],
        ];

        return $sections;
    }
}
