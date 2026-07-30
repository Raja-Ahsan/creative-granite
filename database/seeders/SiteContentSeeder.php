<?php

namespace Database\Seeders;

use App\Models\GalleryAlbum;
use App\Models\HeroSlide;
use App\Models\InstagramPost;
use App\Models\Material;
use App\Models\PortfolioItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\ProjectType;
use App\Models\Service;
use App\Models\ServicePageSection;
use App\Models\ServicePageSectionImage;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSettings();
        $this->seedHeroSlides();
        $this->seedMaterials();
        $this->seedProducts();
        $this->seedProcessSteps();
        $this->seedProjectTypes();
        $this->seedPortfolio();
        $this->seedServices();
        $this->seedInstagramPosts();
        $this->seedGalleryAlbums();
        $this->seedServicesPage();
    }

    private function seedSettings(): void
    {
        $settings = [
            ['key' => 'logo_path', 'value' => '/images/site/update-logo.png', 'type' => 'image', 'group' => 'assets'],
            ['key' => 'about_image_path', 'value' => '/images/site/LakeLine-20.jpg', 'type' => 'image', 'group' => 'assets'],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/creativegraniteanddesign/', 'type' => 'url', 'group' => 'social'],
            ['key' => 'showroom_maps_url', 'value' => 'https://www.google.com/maps/place/1998+N+Redwood+Rd,+Salt+Lake+City,+UT+84116,+USA/@40.8115045,-111.9402546,16.96z/data=!4m6!3m5!1s0x8752f6bad3a740e7:0x54da835cc07f3b51!8m2!3d40.8115002!4d-111.9376702!16s%2Fg%2F11c1zjtg8r?entry=ttu&g_ep=EgoyMDI2MDYyMy4wIKXMDSoASAFQAw%3D%3D', 'type' => 'url', 'group' => 'contact'],
            ['key' => 'address_line_1', 'value' => '1998 n redwood rd', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'address_line_2', 'value' => 'Salt lake city, ut 84116', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '8015745477', 'type' => 'phone', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@creativegranite.com', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'hours', 'value' => '8am – 5pm · Mon – Fri', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_form_intro', 'value' => 'Tell us about your project — we will follow up with next steps, timing, and a path to estimate.', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'founded_year', 'value' => '1998', 'type' => 'string', 'group' => 'general'],
            ['key' => 'footer_tagline', 'value' => 'Built on craftsmanship. Serving Utah since 1998.', 'type' => 'string', 'group' => 'general'],
            ['key' => 'who_we_are_eyebrow', 'value' => 'Who we are', 'type' => 'string', 'group' => 'who_we_are'],
            ['key' => 'who_we_are_heading', 'value' => 'Built on craftsmanship since', 'type' => 'string', 'group' => 'who_we_are'],
            ['key' => 'who_we_are_highlight_text', 'value' => '1998', 'type' => 'string', 'group' => 'who_we_are'],
            ['key' => 'who_we_are_body', 'value' => 'Creative Granite + Design is a Utah-based stone fabrication company specializing in custom countertops and architectural surfaces. We partner with homeowners, builders, and designers to deliver precise fabrication, thoughtful material selection, and high-quality installation across residential and multifamily projects.', 'type' => 'string', 'group' => 'who_we_are'],
            ['key' => 'gallery_eyebrow', 'value' => 'Our Work', 'type' => 'string', 'group' => 'gallery'],
            ['key' => 'gallery_heading', 'value' => 'Explore Our Portfolio', 'type' => 'string', 'group' => 'gallery'],
            ['key' => 'gallery_body', 'value' => 'Discover a curated collection of kitchens, bathrooms, fireplaces, commercial spaces, and custom stone applications that showcase our craftsmanship and attention to detail.', 'type' => 'string', 'group' => 'gallery'],
            ['key' => 'gallery_featured_eyebrow', 'value' => 'Featured Projects', 'type' => 'string', 'group' => 'gallery'],
            ['key' => 'gallery_featured_heading', 'value' => 'A grid of our best projects.', 'type' => 'string', 'group' => 'gallery'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    private function seedHeroSlides(): void
    {
        $slides = [
            ['/images/site/slider1.jpg', 'Luxury kitchen with marble countertops and stone backsplash'],
            ['/images/site/slider2.jpg', 'Bright modern kitchen with white stone island'],
            ['/images/site/slider3.jpg', 'Double-island kitchen with sage cabinetry and stone surfaces'],
        ];

        foreach ($slides as $index => [$path, $alt]) {
            HeroSlide::updateOrCreate(
                ['image_path' => $path],
                ['alt_text' => $alt, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }
    }

    private function seedMaterials(): void
    {
        $items = [
            ['Granite', 'A durable natural stone known for its strength and variation. A reliable choice for kitchens and high-use surfaces.', '/materials/granite.webp'],
            ['Quartz', 'An engineered surface designed for consistency and low maintenance, offering a wide range of colors and styles.', '/materials/quartz.webp'],
            ['Marble', 'A natural stone known for soft movement and timeless appeal, often used in bathrooms and feature areas.', '/materials/marble.webp'],
            ['Quartzite', 'A natural stone valued for durability and distinctive movement, ideal for kitchens and high-traffic spaces.', '/materials/quartzite.webp'],
        ];

        foreach ($items as $index => [$name, $desc, $image]) {
            Material::updateOrCreate(
                ['name' => $name],
                ['description' => $desc, 'image_path' => $image, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }
    }

    private function seedProducts(): void
    {
        $items = [
            ['Kitchen Countertops', 'Custom-fabricated kitchen countertops in granite, quartz, marble, and quartzite. Precision templating and professional installation for new builds and remodels.', '/portfolio/portfolio_2.jpg'],
            ['Bathroom Vanities', 'Elegant bathroom vanity tops and surrounds crafted to complement your design vision. Single and double vanity configurations available.', '/portfolio/024.jpg'],
            ['Fireplace Surrounds', 'Statement fireplace surrounds and hearths in natural and engineered stone. Custom shapes, edge profiles, and finishes.', '/portfolio/067.jpg'],
            ['Outdoor Kitchens', 'Weather-resistant stone surfaces for outdoor kitchens and BBQ islands. Durable materials selected for Utah climate.', '/portfolio/DSC_4182_1.jpg'],
        ];

        foreach ($items as $index => [$name, $desc, $image]) {
            Product::updateOrCreate(
                ['name' => $name],
                ['description' => $desc, 'excerpt' => \Illuminate\Support\Str::limit($desc, 120), 'image_path' => $image, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }
    }

    private function seedProcessSteps(): void
    {
        $steps = [
            ['01', 'Initial Consultation', 'We discuss your project, timeline, and budget in our showroom or on-site.'],
            ['02', 'Estimate & Material Selection', 'We provide a detailed quote and guide you through slab selection from our inventory.'],
            ['03', 'Template & Measurement', 'Our team templates your space with precision for a perfect fit no guesswork.'],
            ['04', 'Fabrication & Install', 'Hand finished edges, sealed surfaces, and a clean, on schedule installation.'],
        ];

        foreach ($steps as $index => [$number, $title, $description]) {
            ProcessStep::updateOrCreate(
                ['title' => $title],
                ['step_number' => $number, 'description' => $description, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }
    }

    private function seedProjectTypes(): void
    {
        $types = [
            'New construction',
            'Remodel & renovation',
            'Multifamily & commercial',
            'Other',
        ];

        foreach ($types as $index => $name) {
            ProjectType::updateOrCreate(
                ['name' => $name],
                ['sort_order' => $index + 1, 'is_active' => true]
            );
        }
    }

    private function seedPortfolio(): void
    {
        $items = [
            ['/portfolio/DSC_4182_1.jpg', 'Carrara Island'],
            ['/portfolio/024.jpg', 'Modern Kitchen'],
            ['/portfolio/portfolio_2.jpg', 'Refined Hearth'],
            ['/portfolio/067.jpg', 'Warm Minimal'],
            ['/portfolio/portfolio_3.jpg', 'Architectural'],
            ['/portfolio/051.jpg', 'Quiet Movement'],
            ['/portfolio/009-1.jpg', 'Coastal Kitchen'],
            ['/portfolio/Creative-Quartz-scaled-1.jpg', 'Creative Quartz'],
            ['/portfolio/DSC_4182.jpg', 'Carrara Island'],
        ];

        foreach ($items as $index => [$path, $title]) {
            PortfolioItem::updateOrCreate(
                ['image_path' => $path, 'title' => $title],
                [
                    'sort_order' => $index + 1,
                    'is_featured' => $index < 3,
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedServices(): void
    {
        $services = [
            ['New Construction', 'Stone fabrication for new builds, working closely with builders, designers, andproject teams to ensure accuracy, efficiency, and consistency from planning through installation.'],
            ['Remodel & Renovation', 'Custom stone surfaces for kitchen, bathroom, and interior remodels focused on thoughtful material selection and clean execution.'],
            ['Multifamily & Commercial', 'Custom stone fabrication for multifamily and commercial projects, supporting developers, contractors, and project teams with efficient xecution, consistent quality, and dependable delivery.'],
        ];

        foreach ($services as $index => [$title, $body]) {
            Service::updateOrCreate(
                ['title' => $title],
                ['body' => $body, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }
    }

    private function seedInstagramPosts(): void
    {
        if (InstagramPost::query()->exists()) {
            return;
        }

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

        foreach ($files as $index => $file) {
            $label = pathinfo($file, PATHINFO_FILENAME);

            InstagramPost::create([
                'title' => $label,
                'image_path' => '/portfolio/instagram/'.rawurlencode($file),
                'alt_text' => 'Creative Granite stone fabrication — '.$label,
                'external_url' => 'https://www.instagram.com/creativegraniteanddesign/',
                'sort_order' => $index + 1,
                'is_featured' => true,
                'is_active' => true,
            ]);
        }
    }

    private function seedGalleryAlbums(): void
    {
        if (GalleryAlbum::query()->exists()) {
            return;
        }

        $categories = [
            ['kitchens', 'Kitchens', 'kitchens-cover.jpg', 'kitchens-gallery.png'],
            ['bathrooms', 'Bathrooms', 'bathrooms-cover.jpg', 'bathrooms-gallery.png'],
            ['fireplaces', 'Fireplaces', 'fireplaces-cover.jpg', 'fireplaces-gallery.png'],
            ['multifamily', 'Multifamily', 'multifamily-cover.jpg', 'multifamily-gallery.png'],
        ];

        foreach ($categories as $index => [$slug, $title, $cover, $gallery]) {
            GalleryAlbum::create([
                'title' => $title,
                'slug' => $slug,
                'kind' => GalleryAlbum::KIND_CATEGORY,
                'cover_path' => '/images/work/'.$cover,
                'gallery_path' => '/images/work/'.$gallery,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }

        $projects = [
            ['norfolk', 'Norfolk', 'norfolk-cover.jpg', 'norfolk-gallery.png'],
            ['sabal', 'Sabal', 'sabal-cover.png', 'sabal-gallery.png'],
            ['lancaster', 'Lancaster', 'lancaster-cover.jpg', 'lancaster-gallery.png'],
            ['2026-parade-home', '2026 Parade Home', 'parade-home-cover.jpg', 'parade-home-gallery.png'],
        ];

        foreach ($projects as $index => [$slug, $title, $cover, $gallery]) {
            GalleryAlbum::create([
                'title' => $title,
                'slug' => $slug,
                'kind' => GalleryAlbum::KIND_PROJECT,
                'cover_path' => '/images/work/'.$cover,
                'gallery_path' => '/images/work/'.$gallery,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }

    private function seedServicesPage(): void
    {
        $settings = [
            ['key' => 'services_page_eyebrow', 'value' => 'Services', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_heading', 'value' => 'Stone Fabrication for Every Stage of Your Project.', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_body', 'value' => 'From custom homes and remodels to multifamily and commercial spaces, we fabricate, install, and support premium stone surfaces built to last.', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_hero_path', 'value' => '/images/services/hero.png', 'type' => 'image', 'group' => 'services_page'],
            ['key' => 'services_page_repairs_number', 'value' => '04', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_repairs_eyebrow', 'value' => 'Repairs & Warranty', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_repairs_heading', 'value' => 'Stand Behind Every Installation', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_repairs_body', 'value' => "Our commitment doesn't end after installation. We provide warranty support for qualifying workmanship and offer repair services to help keep your stone surfaces looking their best.", 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_repairs_image_path', 'value' => '/images/services/repairs-hero-voyager.png', 'type' => 'image', 'group' => 'services_page'],
            ['key' => 'services_page_warranty_title', 'value' => 'Warranty', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_warranty_points', 'value' => "One-year workmanship warranty\nWarranty support for qualifying fabrication and installation issues\nDedicated service team", 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_warranty_cta', 'value' => 'Request a Warranty Repair.', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_repairs_card_title', 'value' => 'Repairs', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_repairs_points', 'value' => "Repair services available by request\nContact us for an evaluation and quote", 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_repairs_cta', 'value' => 'Request a Repair Estimate', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_cta_heading', 'value' => 'Ready to Start Your Project?', 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_cta_body', 'value' => "Whether you're building a custom home, remodeling an existing space, or managing a multifamily or commercial project, our team is ready to bring your vision to life.", 'type' => 'string', 'group' => 'services_page'],
            ['key' => 'services_page_cta_button', 'value' => 'Get an Estimate', 'type' => 'string', 'group' => 'services_page'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        if (ServicePageSection::query()->exists()) {
            return;
        }

        $sections = [
            [
                '01',
                'New Construction & Residential',
                'Partnering with builders, designers, and homeowners to fabricate and install custom stone surfaces with precision from planning through installation.',
                '/images/services/new-construction-hero.jpg',
                [
                    '/images/services/new-construction-1.jpg',
                    '/images/services/new-construction-2.jpg',
                    '/images/services/new-construction-3.jpg',
                ],
            ],
            [
                '02',
                'Remodel & Renovation',
                'Transform kitchens, bathrooms, fireplaces, and living spaces with expertly fabricated stone tailored to your vision.',
                '/images/services/remodel-hero.png',
                [
                    '/images/services/remodel-1.jpg',
                    '/images/services/remodel-2.jpg',
                    '/images/services/remodel-3.jpg',
                ],
            ],
            [
                '03',
                'Multifamily & Commercial',
                'Reliable stone fabrication and installation for multifamily developments, hospitality, retail, healthcare, office, and commercial environments.',
                '/images/services/commercial-hero.jpg',
                [
                    '/images/services/commercial-1.jpg',
                    '/images/services/commercial-2.jpg',
                    '/images/services/commercial-3.jpg',
                ],
            ],
        ];

        foreach ($sections as $index => [$number, $title, $body, $hero, $images]) {
            $section = ServicePageSection::create([
                'number_label' => $number,
                'title' => $title,
                'body' => $body,
                'hero_path' => $hero,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($images as $imageIndex => $path) {
                ServicePageSectionImage::create([
                    'service_page_section_id' => $section->id,
                    'image_path' => $path,
                    'sort_order' => $imageIndex + 1,
                ]);
            }
        }
    }
}
