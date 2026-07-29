<?php

namespace App\Services;

use App\Models\GalleryAlbum;
use App\Models\GalleryAlbumImage;
use App\Models\HeroSlide;
use App\Models\InstagramPost;
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
                'instagramUrl' => $settings['instagram_url']
                    ?: (config('services.instagram.profile_url') ?: 'https://www.instagram.com/creativegraniteanddesign/'),
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
                ->active()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (PortfolioItem $item) => [
                    'src' => $item->image_path,
                    'title' => $item->title,
                    'tag' => '',
                    'featured' => (bool) $item->is_featured,
                ])
                ->values()
                ->all(),
            'galleryAlbums' => GalleryAlbum::query()
                ->with(['images' => fn ($query) => $query->orderBy('sort_order')->orderBy('id')])
                ->active()
                ->ordered()
                ->get()
                ->map(function (GalleryAlbum $album) {
                    $images = $album->images
                        ->map(fn (GalleryAlbumImage $image) => $image->image_path)
                        ->values()
                        ->all();

                    if ($images === [] && $album->gallery_path) {
                        $images = [$album->gallery_path];
                    }

                    return [
                        'slug' => $album->slug,
                        'title' => $album->title,
                        'kind' => $album->kind,
                        'cover' => $album->cover_path,
                        'gallery' => $images[0] ?? $album->gallery_path ?? '',
                        'images' => $images,
                    ];
                })
                ->values()
                ->all(),
            'instagramPosts' => $this->resolveInstagramPosts(),
            'materials' => Material::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (Material $material) => [
                    'name' => $material->name,
                    'desc' => $material->description,
                    'image' => $material->image_path,
                    'sortOrder' => (int) $material->sort_order,
                    'featured' => (bool) $material->is_featured,
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

    private function resolveInstagramPosts(): array
    {
        $profile = config('services.instagram.profile_url')
            ?: 'https://www.instagram.com/creativegraniteanddesign/';

        $adminPosts = InstagramPost::query()
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->limit(12)
            ->get()
            ->map(fn (InstagramPost $post) => [
                'src' => $post->image_path,
                'alt' => $post->alt_text ?: ($post->title ?: 'Creative Granite & Design on Instagram'),
                'url' => $post->external_url ?: $profile,
            ])
            ->values()
            ->all();

        if ($adminPosts !== []) {
            return $adminPosts;
        }

        $live = app(InstagramFeedService::class)->getPosts(12);
        if ($live !== []) {
            return $live;
        }

        return array_slice($this->staticInstagramPosts(), 0, 12);
    }

    private function staticInstagramPosts(): array
    {
        $profile = config('services.instagram.profile_url')
            ?: 'https://www.instagram.com/creativegraniteanddesign/';

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

        return array_map(function (string $file) use ($profile) {
            $label = pathinfo($file, PATHINFO_FILENAME);

            return [
                'src' => '/portfolio/instagram/'.rawurlencode($file),
                'alt' => 'Creative Granite stone fabrication — '.$label,
                'url' => $profile,
            ];
        }, $files);
    }

    private function staticTestimonials(): array
    {
        return [
            ['q' => "Working with Erik and Creative Granite Design has been an excellent experience on my personal home as well as other jobs that I have contracted them on. The attention to detail is phenomenal. My wife had picked out a few slabs of Taj Mahal and Erik went out of his way to find her better looking slabs at a fraction of the price. The installation was superb and the cuts are clean and precise. Alignment is better than expected and they really showcased their talent by placing the character pieces of the stone in the areas that it would look best. I will only work with Creative Granite moving forward.", 'a' => 'Chris Stuber.', 'r' => 'General contractor'],
            ['q' => 'I am a local real estate agent and when my clients are starting a remodel and need countertops, backsplash or a stone surround for a fireplace, Erik at Creative Granite & Design is my only call I need to make! When I first worked with Erik it was for my personal remodel (kitchen and bathroom counter tops). Erik was a standout with his communication and willingness to help me find the best price on the coveted Taj Mahal Quartzite that I wanted in my kitchen. Finding someone who goes above and beyond is more difficult these days, but when you find a gem, you stay with them. I am confident in referring my clients to Erik and Creative Granite & Design as I know they will take care of my client like they took care of me.', 'a' => 'Ali North', 'r' => 'Interior designer'],
            ['q' => 'A couple of years ago we had Creative Granite install kitchen counter tops. They were amazing to work with and the quality workmanship was excellent too. Yes, there were delays from the supplier side and some from their other jobs not going as planned which affected the timing of ours. But I consider that all part of the process. Recommended!', 'a' => 'Ron Kilby', 'r' => 'Developer'],
            ['q' => 'The staff at creative granite are wonderful to work with on large or small projects. Tiffany is the best and I\'ve recommended her for years to all projects. Great at multi -family or custom homes.   ', 'a' => 'Chris Affleck'],
            ['q' => 'Tiffany Magalei is a “Dream” to work with, she is always serviceable and looking for the best way to help you! Definitely a great experience doing a 100+ Multifamily project with her, ready for the next one!', 'a' => 'rolando gallart'],
            ['q' => 'If I could give Creative Granite 10 stars I would. I love this company and the people that work for them so much. From the top down, they are fantastic people. I am a designer and work with them professionally and have also had them put countertops in my own home. They are always so professional and courteous. Installations have always gone so smoothly and the quality of their work is top notch. They truly care about their customers and the quality of their work!', 'a' => 'Kristen Smith'],
            ['q' => 'Would recommend any client to work with Eric and his team here at Creative Granite! They are professional, constantly innovating to provide the best service and craftsmanship and pricing that makes sense for the value they provide. You cannot go wrong with them!', 'a' => 'Vidya Walia'],
            ['q' => 'Tomas came to fix our counters through our warranty on our new build with Ivory. He fixed the caulking and a crack on our counter very beautifully. Tomas did a great job and is a great person to work with!', 'a' => 'Ashley Clingo'],
            ['q' => 'Creative Granite has done two of my personal homes over the years. Both of them were remodels. Both times I was very impressed with the end product and the efficiency at which they did the work. I’ve appreciated the professionalism and persistence on getting the end product right. They are aggressive on price and still deliver a good product in the end.', 'a' => 'Isaac McKay'],
            ['q' => 'Working with Ricardo at Creative Granite was such a pleasure. He always returned calls and responded to text messages in record time. It felt like I was his only customer as he always took time to thoroughly explore and answer my questions and concerns. We had a situation with the tile setters that caused an issue with our granite counter top. One call to Ricardo was all it took.............he sent Tony out right away to assess and resolve the problem. Tony, by the way, is amazing! I swear he is the master problem solver to whom I will be forever grateful. I received very good value for my dollar and the most excellent customer service. I will have no hesitation calling in the future should service be required and I will definitely go to Creative Granite and Design for all future needs! Thank you Ricardo and Tony!!', 'a' => 'Valerie Bills'],
            ['q' => 'Ricardo is the BEST. I love the ease of being able to text pics to the receptionist, Ricardo and his office Manager is AMAZING! The guy who came to estimate was very professional and friendly (Alfonzo?) And the installers were great too. I LOVE my new Counter tops! THANKYOU AGAIN. I would recommend them to everyone!', 'a' => 'Jan Ice'],
            ['q' => 'I couldn\'t recommend Ricardo and his team at Creative Granite any higher. I own a construction business and Creative Granite has been doing my countertops exclusively for 15 years.
After several hundred projects you\'re gonna get a few hiccups here and there but no other fabricator works harder and goes the extra mile than Creative Granite to get it right in the end and make sure the result meets the expectation. After a few years and frustrating experiences with other fabricators I stopped even trying. Creative Granite is one of my most valued trade partners. Thank you for everything Ricardo and staff!', 'a' => 'Bryant Anderson'],
            ['q' => 'I recently worked with Tiffany over at Creative Granite and Design. Honestly my experience was awesome. All my questions were answered, no sales pressure, and felt really comfortable and educated before making my decision. I would highly suggest giving her a call if you are in the market for new countertops. If i have any more renovations in the future i will be working with them again!', 'a' => 'Matt Rigby'],
            ['q' => 'Ricardo and his team at Creative Granite are the best. They showed up on time and their work was flawless. Not to mention the installers were friendly and professional. I will definitely use Creative Granite again and I highly recommend their services!', 'a' => 'Doug'],
            ['q' => 'Recently purchased kitchen counters through Creative Granite. Our sales person was Mike Merino and he was incredibly communicative. I got about 4-5 bids (Accent, Bedrock and 2 others) and Creative had all of their prices beat by a good margin. I love how they turned out and intsall crew was very clean and professional.', 'a' => 'Lindsey Watne'],
            ['q' => 'Excellent service, craftsmanship, and prices. I got the same thing for significantly less money than a quote from another popular stone company. There were so many types of counter tops to choose from. We found exactly the stone slab we wanted. Everyone, from sales rep to the person who measured and the installers were top notch. We couldn\'t be happier.', 'a' => 'Christy Williams'],
            ['q' => 'Creative Granite is wonderful to work with!! We have enjoyed working with them on multiple occasions throughout our house remodel and every time has been such a great experience! Not to mention our granite countertops are beautiful! We couldn\'t be happier. Thanks again to Ricardo and his staff!', 'a' => 'Sheree Funk'],
            ['q' => 'Creative Granite & Design installed a countertop for a desk that I designed and did an incredible job! I would definitely recommend them to friends and family! They took their time and got it exactly how I wanted it and I couldn\'t have asked for a better experience. I will definitely use them again in the future. ', 'a' => 'Brooke Crofts'],
            ['q' => 'Tiffany and the crew were a pleasure to work with. The countertops look fabulous. Price was fair and service exceptional. We will definitely work with them again! ', 'a' => 'Sean Rentmeister'],
            ['q' => 'I love Creative Granite! They have fair pricing. Their staff is so friendly , and they do their absolute best to make sure you are a happy customer', 'a' => '
natasha “Natasha”'],
            ['q' => 'This company has been nothing short of incredible! They have been very friendly and even more helpful with the installation/replacement of our countertops! I would Highly recommend these guys!!', 'a' => 'Shay Pitt'],
            ['q' => 'TAbsolutely 100% recommend Ricardo and his team. They are efficient, clean, professional and do a great job. Very very grateful for the communication and help. Thank you again!!!', 'a' => 'Brittani Wilson'],
            ['q' => 'Jeff & Tyler helped us immensely on material selection as well as saved us money by helping us find remnants that went with our color scheme. My wife & I couldn’t be happier.', 'a' => 'Justin Lake'],
            ['q' => 'They did a great job, excellent price, high quality material and the installers were great!', 'a' => 'Kevin Adamson'],
            ['q' => 'Amy was great to work with the countertops look very nice done very quickly and clean cost was not bad at all either would recommend and or do business with again', 'a' => 'Jr. knoll'],
            ['q' => 'Ricardo does an amazing job and stands behind his work. Their prices are great and their work is amazing. Highly recommended.', 'a' => 'Daniel Willey'],
            ['q' => 'Great price and very friendly! Had it installed a few days ago and it looks beautiful!', 'a' => 'TheAllKnowingMast3r'],
            ['q' => 'Ricardo runs a great company. Always responsive to any questions, and very knowledgable & honest!', 'a' => 'James Harrison'],
            ['q' => 'Their installation team was so friendly. And the countertops turned out amazing.', 'a' => 'Nick Bluth'],
            ['q' => 'Amy is absolutely amazing to work with!!!!! So responsive with me and understood what i was going for.', 'a' => 'Ashley Kae Anderson'],
            ['q' => 'No questions. By far one of the best company.. best prices.. great customer service.', 'a' => 'Eric Heer'],
          
        ];
    }

    private function staticNavLeft(): array
    {
        return [
            ['Work', '/gallery'],
            ['Products', '#'],
            ['Services', '/services'],
        ];
    }

    private function staticNavRight(): array
    {
        return [
            ['Process', '/process'],
            ['Get an Estimate', '#estimate'],
        ];
    }

    private function staticFooterNavLinks(): array
    {
        return [
            ['Work', '/gallery'],
            ['Products', '#'],
            ['Services', '/services'],
            ['Process', '/process'],
            ['Connect us', '/contact'],
        ];
    }

    private function staticFooterSocialLinks(): array
    {
        return [
            ['label' => 'Instagram', 'url' => 'https://www.instagram.com/creativegraniteanddesign/'],
            ['label' => 'Facebook', 'url' => 'https://www.facebook.com/CreativeGraniteDesign/'],
            ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/creative-granite-&-design'],
        ];
    }

    private function staticSections(): array
    {
        $settings = SiteSetting::query()
            ->pluck('value', 'key')
            ->all();

        $defaultWhoBody = 'Creative Granite + Design is a Utah-based stone fabrication company specializing in custom countertops and architectural surfaces. We partner with homeowners, builders, and designers to deliver precise fabrication, thoughtful material selection, and high-quality installation across residential and multifamily projects.';

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
                'eyebrow' => $settings['who_we_are_eyebrow'] ?? 'Who we are',
                'heading' => $settings['who_we_are_heading'] ?? 'Built on craftsmanship since',
                'subheading' => '',
                'body' => $settings['who_we_are_body'] ?? $defaultWhoBody,
                'highlightText' => $settings['who_we_are_highlight_text']
                    ?? ($settings['founded_year'] ?? '1998'),
                'image' => $settings['about_image_path'] ?? '/images/site/LakeLine-20.jpg',
            ],
            'materials' => [
                'eyebrow' => 'Materials',
                'heading' => 'The slab decides everything.',
                'subheading' => 'Explore our most requested natural and engineered surfaces. Each offers its own balance of character, durability, and performance. Additional materials are available upon request.',
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
                'heading' => 'Fabricated with precision. installed with intention.',
                'subheading' => 'A selection of completed spaces, material details, and in between moments each reflecting our approach to stone, design, and execution.',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'gallery' => [
                'eyebrow' => $settings['gallery_eyebrow'] ?? 'Our Work',
                'heading' => $settings['gallery_heading'] ?? 'Explore Our Portfolio',
                'subheading' => '',
                'body' => $settings['gallery_body'] ?? 'Discover a curated collection of kitchens, bathrooms, fireplaces, commercial spaces, and custom stone applications that showcase our craftsmanship and attention to detail.',
                'highlightText' => '',
                'image' => '',
            ],
            'gallery-featured' => [
                'eyebrow' => $settings['gallery_featured_eyebrow'] ?? 'Featured Projects',
                'heading' => $settings['gallery_featured_heading'] ?? 'A grid of our best projects.',
                'subheading' => '',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'instagram' => [
                'eyebrow' => 'Instagram',
                'heading' => 'Follow our work',
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
                'heading' => 'Trusted across Utah',
                'subheading' => '',
                'body' => '',
                'highlightText' => '',
                'image' => '',
            ],
            'cta' => [
                'eyebrow' => 'Final Call to Action',
                'heading' => 'Start your project',
                'subheading' => '',
                'body' => 'Whether you\'re building a custom home, planning a remodel, or managing a multifamily or commercial project, our team is here to help bring it to life.',
                'highlightText' => '',
                'image' => '',
            ],
        ];

        return $sections;
    }
}
