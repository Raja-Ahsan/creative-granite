<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Models\Material;
use App\Models\PortfolioItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\ProjectType;
use App\Models\Service;
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
}
