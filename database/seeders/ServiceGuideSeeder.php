<?php

namespace Database\Seeders;

use App\Models\ServiceGuide;
use Illuminate\Database\Seeder;

class ServiceGuideSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedResidential();
        $this->seedCommercial();
        $this->seedRemodel();
        $this->seedKitchen();
        $this->seedBathroom();
        $this->seedIdaho();
        $this->seedColorado();
        $this->seedWyoming();
    }

    private function seedResidential(): void
    {
        $guide = ServiceGuide::updateOrCreate(
            ['slug' => 'residential-countertops-in-utah'],
            [
                'title' => 'Residential Countertop in Utah',
                'meta_title' => 'Residential Countertops in Utah | Creative Granite & Design',
                'meta_description' => 'Choose residential countertops in Utah for the way the surface will be used. Explore granite, quartzite, marble, and quartz with custom fabrication guidance.',
                'hero_image_path' => '/images/work/kitchens-cover.jpg',
                'hero_body' => null,
                'process_eyebrow' => null,
                'process_heading' => null,
                'process_body' => null,
                'process_image_path' => null,
                'work_eyebrow' => null,
                'work_heading' => null,
                'work_body' => null,
                'work_image_path' => null,
                'materials_eyebrow' => 'Materials',
                'materials_heading' => 'Choose for the Way the Surface Will Be Used',
                'materials_intro' => 'Good Residential countertops in Utah should offer more than an attractive photograph. Granite provides individual mineral patterning and generally robust everyday performance. True quartzite often offers notable hardness and distinctive movement, though varieties differ and should be evaluated individually. Marble has a classic, luminous appearance but can etch from acidic substances.',
                'additional_eyebrow' => 'Additional Materials',
                'additional_heading' => 'Consider the Details Beyond the Slab',
                'additional_body' => 'Porcelain and other special-order materials may also be considered when the design or intended application calls for an alternative. Suitability depends on product specifications, fabrication requirements, edge details, and installation conditions. We prefer to discuss those constraints openly rather than promise that every material will work in every location.',
                'additional_help_text' => 'Need help choosing? Bring your plans, inspiration, or photos of the existing room to a material conversation. We can help compare options with the project’s actual needs in view.',
                'additional_image_path' => '/images/services/remodel-hero.png',
                'advantages_heading' => 'Advantages of a Custom-Fabricated Surface',
                'advantages_body' => 'The value of Residential countertops in Utah lies in the fit between the material and the project. Custom fabrication allows attention to sink openings, edge profiles, seam locations, and unusual dimensions. It also creates opportunities to align visual movement with the layout, rather than treating each section as an isolated piece.',
                'advantages_image_path' => '/images/site/LakeLine-20.jpg',
                'faq_heading' => 'Frequently Asked Questions',
                'cta_heading' => 'Bring Us the Plans or the Ideas!',
                'cta_body' => "If you are considering Residential countertops in Utah, share the approximate dimensions, project location, preferred material, and desired schedule.\nA conversation about the space can help clarify the next step and the information needed for a meaningful estimate. We welcome homeowners as well as builders and design professionals.",
                'sort_order' => 1,
                'is_active' => true,
                'show_in_nav' => true,
                'is_service_area' => false,
            ]
        );

        $guide->steps()->delete();

        $guide->materials()->delete();
        foreach ([
            [
                'name' => 'Granite',
                'body' => 'Granite can be an excellent choice when a project calls for natural variation and a surface intended for regular use. Colors range from quiet neutrals to expressive patterns. Because porosity differs from slab to slab, care recommendations should be based on the actual material.',
                'image_path' => '/materials/granite.webp',
                'sort_order' => 1,
            ],
            [
                'name' => 'Quartzite',
                'body' => 'Quartzite can provide a striking focal point, especially when veining is planned around an island, vanity, or architectural feature. Not every stone sold under a quartzite label behaves identically, so it is important to confirm the specific product and discuss sealing.',
                'image_path' => '/materials/quartzite.webp',
                'sort_order' => 2,
            ],
            [
                'name' => 'Marble',
                'body' => 'Marble is valued for its visual depth and gentle movement, but it requires a realistic understanding of wear. Acidic products can etch the surface, and some spills may stain if not promptly addressed. Many clients appreciate the natural patina that develops over time. Others prefer a less demanding option.',
                'image_path' => '/materials/marble.webp',
                'sort_order' => 3,
            ],
            [
                'name' => 'Quartz',
                'body' => 'Engineered quartz offers a broad selection of colors and patterns, including restrained solids and stone-inspired veining. Its nonporous surface typically does not need sealing, which makes cleaning straightforward. It should still be protected from excessive heat, and manufacturer limitations should be checked for areas with strong sunlight.',
                'image_path' => '/materials/quartz.webp',
                'sort_order' => 4,
            ],
        ] as $material) {
            $guide->materials()->create($material + ['is_active' => true]);
        }

        $guide->faqs()->delete();
        foreach ([
            [
                'question' => 'What countertop materials are best for residential kitchens and bathrooms?',
                'answer' => 'Granite, quartzite, and engineered quartz are common kitchen choices; quartz and selected natural stones also suit bathroom vanities. Marble can be beautiful in bathrooms or kitchens where owners accept its care needs.',
                'sort_order' => 1,
            ],
            [
                'question' => 'How do I choose the right residential countertop for my Utah home?',
                'answer' => 'Compare real slabs or samples alongside cabinet colors, consider daily use, and discuss maintenance and budget before finalizing an edge or finish.',
                'sort_order' => 2,
            ],
            [
                'question' => 'How long does residential countertop installation take in Utah?',
                'answer' => 'The on-site fitting may be completed relatively quickly for a straightforward project, but the overall schedule also includes selection, measurement, fabrication, and coordination. Request a project-specific timeline.',
                'sort_order' => 3,
            ],
        ] as $faq) {
            $guide->faqs()->create($faq + ['is_active' => true]);
        }

        $guide->buttons()->delete();
        foreach ([
            ['section' => 'materials_cta', 'label' => 'Start Your Project', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
            ['section' => 'materials_cta', 'label' => 'Explore Remnants', 'url' => '/remnants', 'sort_order' => 3],
            ['section' => 'closing_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'closing_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
        ] as $button) {
            $guide->buttons()->create($button + ['is_active' => true]);
        }
    }

    private function seedCommercial(): void
    {
        $guide = ServiceGuide::updateOrCreate(
            ['slug' => 'commercial-countertops-utah'],
            [
                'title' => 'Commercial Countertops Utah',
                'meta_title' => 'Commercial Countertops Utah | Creative Granite & Design',
                'meta_description' => 'Commercial countertops in Utah for reception desks, hospitality counters, office kitchens, and retail displays—custom fabricated for the demands of the setting.',
                'hero_image_path' => '/images/services/commercial-hero.jpg',
                'hero_body' => 'The first impression of a reception desk or hospitality counter begins long before anyone notices its joinery. It begins with a surface that looks appropriate for the business and stands up to the demands of the setting.',
                'process_eyebrow' => 'Services',
                'process_heading' => 'From Planning to Installation',
                'process_body' => 'Our process for commercial countertops Utah is organized around decisions that are easier to make before fabrication. We begin by reviewing the project scope and material preferences, then confirm measurements when the site is ready. Cutouts, edges, seams, and installation conditions are considered together rather than independently.',
                'process_image_path' => '/images/services/commercial-1.jpg',
                'work_eyebrow' => 'Our Work',
                'work_heading' => 'Made to Fit the Space',
                'work_body' => 'Reception desks, office kitchens, hospitality counters, retail displays, and selected public-facing worktops benefit from materials matched to cleaning routines and expected traffic. Material direction matters, but so do the smaller details: how the stone meets a wall, where a seam falls, and how an edge feels to the hand.',
                'work_image_path' => '/images/services/commercial-2.jpg',
                'materials_eyebrow' => 'Materials',
                'materials_heading' => 'Choose for the Way the Surface Will Be Used',
                'materials_intro' => 'Good commercial countertops in Utah should offer more than an attractive photograph. Granite provides individual mineral patterning and generally robust everyday performance. True quartzite often offers notable hardness and distinctive movement, though varieties differ and should be evaluated individually. Marble has a classic, luminous appearance but can etch from acidic substances.',
                'additional_eyebrow' => 'Additional Materials',
                'additional_heading' => 'Additional Materials',
                'additional_body' => 'Porcelain and other special-order materials may also be considered when the design or intended application calls for an alternative. Suitability depends on product specifications, fabrication requirements, edge details, and installation conditions. We prefer to discuss those constraints openly rather than promise that every material will work in every location.',
                'additional_help_text' => 'Need help choosing? Bring your plans, inspiration, or photos of the existing room to a material conversation. We can help compare options with the project’s actual needs in view.',
                'additional_image_path' => '/images/services/commercial-3.jpg',
                'advantages_heading' => 'Advantages of a Custom-Fabricated Surface',
                'advantages_body' => 'The value of commercial countertops in Utah lies in the fit between the material and the project. Custom fabrication allows attention to sink openings, edge profiles, seam locations, and unusual dimensions. It also creates opportunities to align visual movement with the layout, rather than treating each section as an isolated piece.',
                'advantages_image_path' => '/images/work/multifamily-cover.jpg',
                'faq_heading' => 'Frequently Asked Questions',
                'cta_heading' => 'Let’s Start Your Project Today!',
                'cta_body' => 'If you are considering commercial countertops in Utah, share the approximate dimensions, project location, preferred material, and desired schedule. A conversation about the space can help clarify the next step and the information needed for a meaningful estimate. We welcome homeowners as well as builders and design professionals.',
                'sort_order' => 2,
                'is_active' => true,
                'show_in_nav' => true,
                'is_service_area' => false,
            ]
        );

        $guide->steps()->delete();
        foreach ([
            [
                'step_number' => '01',
                'title' => 'Consultation and Material Selection',
                'body' => 'We discuss the intended use, design direction, maintenance expectations, and practical budget considerations.',
                'sort_order' => 1,
            ],
            [
                'step_number' => '02',
                'title' => 'Precision Fabrication',
                'body' => 'Layout, dimensions, openings, and edge treatment are planned around the selected slab or engineered product.',
                'sort_order' => 2,
            ],
            [
                'step_number' => '03',
                'title' => 'Professional Installation',
                'body' => 'Fit, support, joints, and finishing details receive careful attention at the installation stage.',
                'sort_order' => 3,
            ],
        ] as $step) {
            $guide->steps()->create($step + ['is_active' => true]);
        }

        $guide->materials()->delete();
        foreach ([
            [
                'name' => 'Granite',
                'body' => 'Granite can be an excellent choice when a project calls for natural variation and a surface intended for regular use. Colors range from quiet neutrals to expressive patterns. Because porosity differs from slab to slab, care recommendations should be based on the actual material.',
                'image_path' => '/materials/granite.webp',
                'sort_order' => 1,
            ],
            [
                'name' => 'Quartz',
                'body' => 'Engineered quartz offers a broad selection of colors and patterns, including restrained solids and stone-inspired veining. Its nonporous surface typically does not need sealing, which makes cleaning straightforward. It should still be protected from excessive heat, and manufacturer limitations should be checked for areas with strong sunlight.',
                'image_path' => '/materials/quartz.webp',
                'sort_order' => 2,
            ],
        ] as $material) {
            $guide->materials()->create($material + ['is_active' => true]);
        }

        $guide->faqs()->delete();
        foreach ([
            [
                'question' => 'What types of commercial countertops are available in Utah?',
                'answer' => 'Granite, quartzite, marble, and engineered quartz may be considered depending on the intended interior use; special-order materials can be discussed for project-specific needs.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Which countertop materials are best for commercial spaces?',
                'answer' => 'Engineered quartz is often useful for consistent appearance and straightforward cleaning, while granite and selected quartzites suit applications that benefit from natural stone. Material suitability depends on traffic and cleaning protocols.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Can commercial countertops be customized for offices, restaurants, and retail spaces in Utah?',
                'answer' => 'Yes. Dimensions, cutouts, edges, and material layouts can be planned for each project. Food-service and regulated spaces also require confirmation of applicable codes and sanitation requirements.',
                'sort_order' => 3,
            ],
            [
                'question' => 'How long does commercial countertop installation take?',
                'answer' => 'Timing depends on approved plans, quantities, site readiness, and access. Larger installations may be phased to coordinate with other trades.',
                'sort_order' => 4,
            ],
        ] as $faq) {
            $guide->faqs()->create($faq + ['is_active' => true]);
        }

        $guide->buttons()->delete();
        foreach ([
            ['section' => 'hero_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'process_cta', 'label' => 'Explore Our Services', 'url' => '/services', 'sort_order' => 1],
            ['section' => 'work_cta', 'label' => 'View Our Work', 'url' => '/work', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Start Your Project', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
            ['section' => 'materials_cta', 'label' => 'Explore Remnants', 'url' => '/remnants', 'sort_order' => 3],
            ['section' => 'closing_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'closing_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
        ] as $button) {
            $guide->buttons()->create($button + ['is_active' => true]);
        }
    }

    private function seedRemodel(): void
    {
        $guide = ServiceGuide::updateOrCreate(
            ['slug' => 'countertop-remodel-utah'],
            [
                'title' => 'Countertop Remodel Utah',
                'meta_title' => 'Countertop Remodel Utah | Creative Granite & Design',
                'meta_description' => 'Countertop remodel in Utah—replace tired surfaces without a full renovation. Custom fabrication and installation for kitchens, baths, and refresh projects.',
                'hero_image_path' => '/images/services/remodel-hero.png',
                'hero_body' => 'A tired countertop can make otherwise beautiful cabinetry feel dated. Replacing the surface can change the room’s character without requiring a complete renovation, provided the existing cabinets and supporting structure are suitable. Creative Granite + Design provides custom fabrication and installation with attention to the material, the setting, and the people who will use the finished surface.',
                'process_eyebrow' => 'Services',
                'process_heading' => 'From Planning to Installation',
                'process_body' => 'Our process for countertop remodel Utah is organized around decisions that are easier to make before fabrication. We begin by reviewing the project scope and material preferences, then confirm measurements when the site is ready. Cutouts, edges, seams, and installation conditions are considered together rather than independently.',
                'process_image_path' => '/images/services/remodel-1.jpg',
                'work_eyebrow' => 'Our Work',
                'work_heading' => 'Made to Fit the Space',
                'work_body' => 'Kitchen islands, bathroom vanities, laundry counters, and small refresh projects can all benefit from material changes selected to suit the surrounding room. Material direction matters, but so do the smaller details: how the stone meets a wall, where a seam falls, and how an edge feels to the hand.',
                'work_image_path' => '/images/services/remodel-2.jpg',
                'materials_eyebrow' => 'Materials',
                'materials_heading' => 'Choose for the Way the Surface Will Be Used',
                'materials_intro' => 'Good countertop remodel Utah should offer more than an attractive photograph. Granite provides individual mineral patterning and generally robust everyday performance. True quartzite often offers notable hardness and distinctive movement, though varieties differ and should be evaluated individually. Marble has a classic, luminous appearance but can etch from acidic substances.',
                'additional_eyebrow' => 'Additional Materials',
                'additional_heading' => 'Consider the Details Beyond the Slab',
                'additional_body' => 'Porcelain and other special-order materials may also be considered when the design or intended application calls for an alternative. Suitability depends on product specifications, fabrication requirements, edge details, and installation conditions. We prefer to discuss those constraints openly rather than promise that every material will work in every location.',
                'additional_help_text' => 'Need help choosing? Bring your plans, inspiration, or photos of the existing room to a material conversation. We can help compare options with the project’s actual needs in view.',
                'additional_image_path' => '/images/services/remodel-3.jpg',
                'advantages_heading' => 'Advantages of a Custom-Fabricated Surface',
                'advantages_body' => 'The value of countertop remodel Utah lies in the fit between the material and the project. Custom fabrication allows attention to sink openings, edge profiles, seam locations, and unusual dimensions. It also creates opportunities to align visual movement with the layout, rather than treating each section as an isolated piece.',
                'advantages_image_path' => '/images/work/kitchens-cover.jpg',
                'faq_heading' => 'Frequently Asked Questions',
                'cta_heading' => 'Start Your Project!',
                'cta_body' => 'If you are considering a countertop remodel in Utah, share the approximate dimensions, project location, preferred material, and desired schedule. A conversation about the space can help clarify the next step and the information needed for a meaningful estimate. We welcome homeowners as well as builders and design professionals.',
                'sort_order' => 3,
                'is_active' => true,
                'show_in_nav' => true,
                'is_service_area' => false,
            ]
        );

        $guide->steps()->delete();
        foreach ([
            [
                'step_number' => '01',
                'title' => 'Consultation and Material Selection',
                'body' => 'We discuss the intended use, design direction, maintenance expectations, and practical budget considerations.',
                'sort_order' => 1,
            ],
            [
                'step_number' => '02',
                'title' => 'Precision Fabrication',
                'body' => 'Layout, dimensions, openings, and edge treatment are planned around the selected slab or engineered product.',
                'sort_order' => 2,
            ],
            [
                'step_number' => '03',
                'title' => 'Professional Installation',
                'body' => 'Fit, support, joints, and finishing details receive careful attention at the installation stage.',
                'sort_order' => 3,
            ],
        ] as $step) {
            $guide->steps()->create($step + ['is_active' => true]);
        }

        $guide->materials()->delete();
        foreach ([
            [
                'name' => 'Granite',
                'body' => 'Granite can be an excellent choice when a project calls for natural variation and a surface intended for regular use. Colors range from quiet neutrals to expressive patterns. Because porosity differs from slab to slab, care recommendations should be based on the actual material.',
                'image_path' => '/materials/granite.webp',
                'sort_order' => 1,
            ],
            [
                'name' => 'Quartz',
                'body' => 'Engineered quartz offers a broad selection of colors and patterns, including restrained solids and stone-inspired veining. Its nonporous surface typically does not need sealing, which makes cleaning straightforward. It should still be protected from excessive heat, and manufacturer limitations should be checked for areas with strong sunlight.',
                'image_path' => '/materials/quartz.webp',
                'sort_order' => 2,
            ],
        ] as $material) {
            $guide->materials()->create($material + ['is_active' => true]);
        }

        $guide->faqs()->delete();
        foreach ([
            [
                'question' => 'How much does a countertop remodel cost in Utah?',
                'answer' => 'Cost depends on selected material, square footage, edge details, cutouts, removal work, and installation conditions. A measured, itemized estimate is more useful than a generic price per square foot.',
                'sort_order' => 1,
            ],
            [
                'question' => 'What are the best countertop materials for a kitchen remodel in Utah?',
                'answer' => 'Granite, quartzite, and engineered quartz are common options. Marble can also work when its appearance and maintenance characteristics match the household.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Can I replace my existing countertops without remodeling my entire kitchen?',
                'answer' => 'Often yes, provided cabinets are level, sound, and capable of supporting the new material. Existing backsplash, sink, and plumbing conditions must be checked.',
                'sort_order' => 3,
            ],
            [
                'question' => 'How long does a countertop remodeling project take in Utah?',
                'answer' => 'Fabrication and scheduling usually take longer than the on-site installation itself. The specific timeline depends on measurements, material availability, and removal conditions.',
                'sort_order' => 4,
            ],
            [
                'question' => 'How do I choose the right countertops for my Utah home renovation?',
                'answer' => 'Start with cabinet colors, room lighting, budget, daily use, and willingness to maintain natural stone; then compare full-size material options.',
                'sort_order' => 5,
            ],
        ] as $faq) {
            $guide->faqs()->create($faq + ['is_active' => true]);
        }

        $guide->buttons()->delete();
        foreach ([
            ['section' => 'hero_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'process_cta', 'label' => 'Explore Our Services', 'url' => '/services', 'sort_order' => 1],
            ['section' => 'work_cta', 'label' => 'View Our Work', 'url' => '/work', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Start Your Project', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
            ['section' => 'materials_cta', 'label' => 'Explore Remnants', 'url' => '/remnants', 'sort_order' => 3],
            ['section' => 'closing_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'closing_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
        ] as $button) {
            $guide->buttons()->create($button + ['is_active' => true]);
        }
    }

    private function seedKitchen(): void
    {
        $guide = ServiceGuide::updateOrCreate(
            ['slug' => 'kitchen-countertops-utah'],
            [
                'title' => 'Kitchen Countertops Utah',
                'meta_title' => 'Kitchen Countertops Utah | Creative Granite & Design',
                'meta_description' => 'Kitchen countertops in Utah—custom fabrication and installation in granite, quartzite, marble, and quartz for islands, perimeters, and everyday kitchens.',
                'hero_image_path' => '/images/work/kitchens-cover.jpg',
                'hero_body' => 'A kitchen countertop does more than complete the cabinetry. It becomes the place where groceries land, meals begin, conversations linger, and everyday routines gather momentum. Creative Granite + Design provides custom fabrication and installation with attention to the material, the setting, and the people who will use the finished surface.',
                'process_eyebrow' => 'Services',
                'process_heading' => 'From Planning to Installation',
                'process_body' => 'Our process for kitchen countertops in Utah is organized around decisions that are easier to make before fabrication. We begin by reviewing the project scope and material preferences, then confirm measurements when the site is ready. Cutouts, edges, seams, and installation conditions are considered together rather than independently.',
                'process_image_path' => '/images/services/new-construction-1.jpg',
                'work_eyebrow' => 'Our Work',
                'work_heading' => 'Made to Fit the Space',
                'work_body' => 'An island can become a dramatic focal point, while quieter perimeter counters may provide visual balance and practical work areas. Material direction matters, but so do the smaller details: how the stone meets a wall, where a seam falls, and how an edge feels to the hand.',
                'work_image_path' => '/images/services/new-construction-2.jpg',
                'materials_eyebrow' => 'Materials',
                'materials_heading' => 'Choose for the Way the Surface Will Be Used',
                'materials_intro' => 'Good kitchen countertops Utah should offer more than an attractive photograph. Granite provides individual mineral patterning and generally robust everyday performance. True quartzite often offers notable hardness and distinctive movement, though varieties differ and should be evaluated individually. Marble has a classic, luminous appearance but can etch from acidic substances.',
                'additional_eyebrow' => 'Additional Materials',
                'additional_heading' => 'Additional Materials',
                'additional_body' => 'Porcelain and other special-order materials may also be considered when the design or intended application calls for an alternative. Suitability depends on product specifications, fabrication requirements, edge details, and installation conditions. We prefer to discuss those constraints openly rather than promise that every material will work in every location.',
                'additional_help_text' => 'Need help choosing? Bring your plans, inspiration, or photos of the existing room to a material conversation. We can help compare options with the project’s actual needs in view.',
                'additional_image_path' => '/images/services/new-construction-3.jpg',
                'advantages_heading' => 'Advantages of a Custom-Fabricated Surface',
                'advantages_body' => 'The value of kitchen countertops in Utah lies in the fit between the material and the project. Custom fabrication allows attention to sink openings, edge profiles, seam locations, and unusual dimensions. It also creates opportunities to align visual movement with the layout, rather than treating each section as an isolated piece.',
                'advantages_image_path' => '/images/work/kitchens-gallery.png',
                'faq_heading' => 'Frequently Asked Questions',
                'cta_heading' => 'Start Your Project!',
                'cta_body' => 'If you are considering kitchen countertops in Utah, share the approximate dimensions, project location, preferred material, and desired schedule. A conversation about the space can help clarify the next step and the information needed for a meaningful estimate. We welcome homeowners as well as builders and design professionals.',
                'sort_order' => 4,
                'is_active' => true,
                'show_in_nav' => true,
                'is_service_area' => false,
            ]
        );

        $guide->steps()->delete();
        foreach ([
            [
                'step_number' => '01',
                'title' => 'Consultation and Material Selection',
                'body' => 'We discuss the intended use, design direction, maintenance expectations, and practical budget considerations.',
                'sort_order' => 1,
            ],
            [
                'step_number' => '02',
                'title' => 'Precision Fabrication',
                'body' => 'Layout, dimensions, openings, and edge treatment are planned around the selected slab or engineered product.',
                'sort_order' => 2,
            ],
            [
                'step_number' => '03',
                'title' => 'Professional Installation',
                'body' => 'Fit, support, joints, and finishing details receive careful attention at the installation stage.',
                'sort_order' => 3,
            ],
        ] as $step) {
            $guide->steps()->create($step + ['is_active' => true]);
        }

        $guide->materials()->delete();
        foreach ([
            [
                'name' => 'Granite',
                'body' => 'Granite can be an excellent choice when a project calls for natural variation and a surface intended for regular use. Colors range from quiet neutrals to expressive patterns. Because porosity differs from slab to slab, care recommendations should be based on the actual material.',
                'image_path' => '/materials/granite.webp',
                'sort_order' => 1,
            ],
            [
                'name' => 'Quartzite',
                'body' => 'Quartzite can provide a striking focal point, especially when veining is planned around an island, vanity, or architectural feature. Not every stone sold under a quartzite label behaves identically, so it is important to confirm the specific product and discuss sealing.',
                'image_path' => '/materials/quartzite.webp',
                'sort_order' => 2,
            ],
            [
                'name' => 'Marble',
                'body' => 'Marble is valued for its visual depth and gentle movement, but it requires a realistic understanding of wear. Acidic products can etch the surface, and some spills may stain if not promptly addressed. Many clients appreciate the natural patina that develops over time. Others prefer a less demanding option.',
                'image_path' => '/materials/marble.webp',
                'sort_order' => 3,
            ],
            [
                'name' => 'Quartz',
                'body' => 'Engineered quartz offers a broad selection of colors and patterns, including restrained solids and stone-inspired veining. Its nonporous surface typically does not need sealing, which makes cleaning straightforward. It should still be protected from excessive heat, and manufacturer limitations should be checked for areas with strong sunlight.',
                'image_path' => '/materials/quartz.webp',
                'sort_order' => 4,
            ],
        ] as $material) {
            $guide->materials()->create($material + ['is_active' => true]);
        }

        $guide->faqs()->delete();
        foreach ([
            [
                'question' => 'What are the best kitchen countertops in Utah for durability and style?',
                'answer' => 'Granite, true quartzite, and engineered quartz are common choices for active kitchens. The right option depends on the specific product, appearance, and maintenance expectations.',
                'sort_order' => 1,
            ],
            [
                'question' => 'How much do custom kitchen countertops cost in Utah?',
                'answer' => 'Prices vary with material, dimensions, thickness, edge treatment, cutouts, and fabrication complexity. Request an estimate based on your layout and selected material.',
                'sort_order' => 2,
            ],
            [
                'question' => 'What materials are available for custom kitchen countertops in Utah?',
                'answer' => 'Granite, quartzite, marble, and engineered quartz form the core selection, with other options available to discuss for particular projects.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Can I customize my kitchen countertops to match my kitchen design?',
                'answer' => 'Yes. Material selection, slab layout, edge profiles, backsplashes, and appropriate cutouts can be planned around the cabinetry and room design.',
                'sort_order' => 4,
            ],
            [
                'question' => 'How long does kitchen countertop installation take in Utah?',
                'answer' => 'On-site installation timing depends on the number of pieces and complexity; the full project includes material selection, templating, fabrication, and scheduling.',
                'sort_order' => 5,
            ],
        ] as $faq) {
            $guide->faqs()->create($faq + ['is_active' => true]);
        }

        $guide->buttons()->delete();
        foreach ([
            ['section' => 'hero_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'process_cta', 'label' => 'Explore Our Services', 'url' => '/services', 'sort_order' => 1],
            ['section' => 'work_cta', 'label' => 'View Our Work', 'url' => '/work', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Start Your Project', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
            ['section' => 'materials_cta', 'label' => 'Explore Remnants', 'url' => '/remnants', 'sort_order' => 3],
            ['section' => 'closing_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'closing_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
        ] as $button) {
            $guide->buttons()->create($button + ['is_active' => true]);
        }
    }

    private function seedBathroom(): void
    {
        $guide = ServiceGuide::updateOrCreate(
            ['slug' => 'bathroom-countertops-utah'],
            [
                'title' => 'Bathroom Countertops Utah',
                'meta_title' => 'Bathroom Countertops Utah | Creative Granite & Design',
                'meta_description' => 'Bathroom countertops in Utah—custom vanity fabrication and installation in granite, quartzite, marble, and quartz for powder rooms to primary suites.',
                'hero_image_path' => '/images/work/bathrooms-cover.jpg',
                'hero_body' => 'A bathroom vanity is a small surface with a demanding job. It must sit comfortably beside mirrors, faucets, storage, and lighting while handling splashes, cosmetics, and the pace of everyday routines. Creative Granite + Design provides custom fabrication and installation with attention to the material, the setting, and the people who will use the finished surface.',
                'process_eyebrow' => 'Services',
                'process_heading' => 'From Planning to Installation',
                'process_body' => 'Our process for bathroom countertops in Utah is organized around decisions that are easier to make before fabrication. We begin by reviewing the project scope and material preferences, then confirm measurements when the site is ready. Cutouts, edges, seams, and installation conditions are considered together rather than independently.',
                'process_image_path' => '/images/services/remodel-1.jpg',
                'work_eyebrow' => 'Our Work',
                'work_heading' => 'Made to Fit the Space',
                'work_body' => 'Single vanities, double-sink arrangements, powder rooms, guest bathrooms, and larger primary suites each benefit from a layout that respects available space. Material direction matters, but so do the smaller details: how the stone meets a wall, where a seam falls, and how an edge feels to the hand.',
                'work_image_path' => '/images/work/bathrooms-gallery.png',
                'materials_eyebrow' => 'Materials',
                'materials_heading' => 'Choose for the Way the Surface Will Be Used',
                'materials_intro' => 'Good bathroom countertops Utah should offer more than an attractive photograph. Granite provides individual mineral patterning and generally robust everyday performance. True quartzite often offers notable hardness and distinctive movement, though varieties differ and should be evaluated individually. Marble has a classic, luminous appearance but can etch from acidic substances.',
                'additional_eyebrow' => 'Additional Materials',
                'additional_heading' => 'Consider the Details Beyond the Slab',
                'additional_body' => 'Porcelain and other special-order materials may also be considered when the design or intended application calls for an alternative. Suitability depends on product specifications, fabrication requirements, edge details, and installation conditions. We prefer to discuss those constraints openly rather than promise that every material will work in every location.',
                'additional_help_text' => 'Need help choosing? Bring your plans, inspiration, or photos of the existing room to a material conversation. We can help compare options with the project’s actual needs in view.',
                'additional_image_path' => '/images/services/remodel-3.jpg',
                'advantages_heading' => 'Advantages of a Custom-Fabricated Surface',
                'advantages_body' => 'The value of bathroom countertops in Utah lies in the fit between the material and the project. Custom fabrication allows attention to sink openings, edge profiles, seam locations, and unusual dimensions. It also creates opportunities to align visual movement with the layout, rather than treating each section as an isolated piece.',
                'advantages_image_path' => '/images/site/LakeLine-20.jpg',
                'faq_heading' => 'Frequently Asked Questions',
                'cta_heading' => 'Start Your Project Now!',
                'cta_body' => 'If you are considering bathroom countertops in Utah, share the approximate dimensions, project location, preferred material, and desired schedule. A conversation about the space can help clarify the next step and the information needed for a meaningful estimate. We welcome homeowners as well as builders and design professionals.',
                'sort_order' => 5,
                'is_active' => true,
                'show_in_nav' => true,
                'is_service_area' => false,
            ]
        );

        $guide->steps()->delete();
        foreach ([
            [
                'step_number' => '01',
                'title' => 'Consultation and Material Selection',
                'body' => 'We discuss the intended use, design direction, maintenance expectations, and practical budget considerations.',
                'sort_order' => 1,
            ],
            [
                'step_number' => '02',
                'title' => 'Precision Fabrication',
                'body' => 'Layout, dimensions, openings, and edge treatment are planned around the selected slab or engineered product.',
                'sort_order' => 2,
            ],
            [
                'step_number' => '03',
                'title' => 'Professional Installation',
                'body' => 'Fit, support, joints, and finishing details receive careful attention at the installation stage.',
                'sort_order' => 3,
            ],
        ] as $step) {
            $guide->steps()->create($step + ['is_active' => true]);
        }

        $guide->materials()->delete();
        foreach ([
            [
                'name' => 'Granite',
                'body' => 'Granite can be an excellent choice when a project calls for natural variation and a surface intended for regular use. Colors range from quiet neutrals to expressive patterns. Because porosity differs from slab to slab, care recommendations should be based on the actual material.',
                'image_path' => '/materials/granite.webp',
                'sort_order' => 1,
            ],
            [
                'name' => 'Quartzite',
                'body' => 'Quartzite can provide a striking focal point, especially when veining is planned around an island, vanity, or architectural feature. Not every stone sold under a quartzite label behaves identically, so it is important to confirm the specific product and discuss sealing.',
                'image_path' => '/materials/quartzite.webp',
                'sort_order' => 2,
            ],
            [
                'name' => 'Marble',
                'body' => 'Marble is valued for its visual depth and gentle movement, but it requires a realistic understanding of wear. Acidic products can etch the surface, and some spills may stain if not promptly addressed. Many clients appreciate the natural patina that develops over time. Others prefer a less demanding option.',
                'image_path' => '/materials/marble.webp',
                'sort_order' => 3,
            ],
            [
                'name' => 'Quartz',
                'body' => 'Engineered quartz offers a broad selection of colors and patterns, including restrained solids and stone-inspired veining. Its nonporous surface typically does not need sealing, which makes cleaning straightforward. It should still be protected from excessive heat, and manufacturer limitations should be checked for areas with strong sunlight.',
                'image_path' => '/materials/quartz.webp',
                'sort_order' => 4,
            ],
        ] as $material) {
            $guide->materials()->create($material + ['is_active' => true]);
        }

        $guide->faqs()->delete();
        foreach ([
            [
                'question' => 'What countertop materials work best for Utah bathroom vanities?',
                'answer' => 'Engineered quartz is convenient for routine cleaning; granite and quartzite offer natural character. Marble is a popular design choice when owners accept etching and care needs.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Are custom bathroom countertops in Utah available for double-sink vanities?',
                'answer' => 'Yes. A custom layout can account for two basins, faucet placement, cabinet spacing, and the position of seams where required.',
                'sort_order' => 2,
            ],
            [
                'question' => 'How do I choose a countertop that resists moisture and everyday bathroom use?',
                'answer' => 'Consider a suitable material, properly sealed joints, sensible cleaning practices, and manufacturer guidance. No countertop substitutes for good waterproofing around fixtures.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Can bathroom countertops be made to fit small or unusually shaped spaces?',
                'answer' => 'Custom templating can accommodate many irregular walls, alcoves, and compact vanity layouts, subject to site conditions.',
                'sort_order' => 4,
            ],
            [
                'question' => 'What design options are available for custom bathroom countertops in Utah?',
                'answer' => 'Options may include material, color, pattern, edge profile, finish, backsplash height, and sink cutout style.',
                'sort_order' => 5,
            ],
        ] as $faq) {
            $guide->faqs()->create($faq + ['is_active' => true]);
        }

        $guide->buttons()->delete();
        foreach ([
            ['section' => 'hero_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'process_cta', 'label' => 'Explore Our Services', 'url' => '/services', 'sort_order' => 1],
            ['section' => 'work_cta', 'label' => 'View Our Work', 'url' => '/work', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Start Your Project', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'materials_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
            ['section' => 'materials_cta', 'label' => 'Explore Remnants', 'url' => '/remnants', 'sort_order' => 3],
            ['section' => 'closing_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'closing_cta', 'label' => 'Visit the Showroom', 'url' => '/contact', 'sort_order' => 2],
        ] as $button) {
            $guide->buttons()->create($button + ['is_active' => true]);
        }
    }

    private function seedIdaho(): void
    {
        $guide = ServiceGuide::updateOrCreate(
            ['slug' => 'countertop-installation-idaho'],
            [
                'title' => 'Countertop Installation Idaho',
                'meta_title' => 'Countertop Installation Idaho | Creative Granite & Design',
                'meta_description' => 'Countertop installation for Idaho projects—quartzite, granite, marble, and quartz with custom fabrication. Ask about service availability for your location.',
                'hero_image_path' => '/images/services/new-construction-hero.jpg',
                'hero_body' => 'Homes and projects across Idaho can vary widely in style, from restrained modern interiors to warmer natural palettes. Rather than assume one surface fits them all, we begin with how the room will be used and what the owner wants the material to contribute.',
                'process_eyebrow' => 'Who We Are',
                'process_heading' => 'Stone Fabrication with a Practical Point of View',
                'process_body' => 'Established in 1998, Creative Granite + Design works with homeowners, builders, and designers on custom stone surfaces. Our approach connects material selection with fabrication details, including edge profiles, sink openings, seam placement, and installation conditions.',
                'process_image_path' => '/images/services/new-construction-1.jpg',
                'work_eyebrow' => 'Our Work',
                'work_heading' => 'Details That Shape the Finished Room',
                'work_body' => 'An attractive slab is only the beginning. The position of a seam can change how a long island reads, while a backsplash or edge profile can connect the surface to surrounding cabinetry. Review completed work for examples of scale, pattern movement, and finishing details, but remember that natural stone is never perfectly repeatable.',
                'work_image_path' => '/images/work/multifamily-cover.jpg',
                'materials_eyebrow' => 'Materials',
                'materials_heading' => 'Materials to Compare Performance Before Choosing a Pattern',
                'materials_intro' => 'Selecting a countertop should involve more than color. Natural stones vary from slab to slab, while engineered surfaces offer greater pattern consistency. Think about food preparation, spills, cleaning products, sunlight, and the way the material will meet surrounding finishes.',
                'additional_eyebrow' => 'Additional Materials',
                'additional_heading' => 'Additional Materials to Explore the Right Application',
                'additional_body' => 'Porcelain and other special-order surfaces may be available for projects that call for a different look or specific performance characteristics. Product suitability depends on the installation environment and manufacturer requirements.',
                'additional_help_text' => null,
                'additional_image_path' => '/images/services/commercial-3.jpg',
                'advantages_heading' => 'How to Plan a Countertop Project',
                'advantages_body' => 'Begin with a drawing or approximate dimensions, photographs of the existing space, and notes about sinks, appliances, and cabinet conditions. Decide which visual features matter most: a quiet neutral surface, a dramatic natural pattern, or consistent material across several rooms. Then ask for a project-specific estimate that explains the material, fabrication, installation scope, and any travel considerations.',
                'advantages_image_path' => '/images/site/LakeLine-20.jpg',
                'faq_heading' => 'Frequently Asked Questions',
                'cta_heading' => 'Start Your Project to Discuss the Location and the Details',
                'cta_body' => 'Considering countertop installation in Idaho? We can help clarify the selection and fabrication questions, then confirm whether installation service is available at the requested Idaho location.',
                'sort_order' => 6,
                'is_active' => true,
                'show_in_nav' => false,
                'is_service_area' => true,
            ]
        );

        $guide->steps()->delete();
        foreach ([
            [
                'step_number' => '01',
                'title' => 'Residential and New Construction',
                'body' => 'Kitchens, bathrooms, and new homes benefit from accurate measurements and coordination with cabinetry, plumbing, and project schedules.',
                'sort_order' => 1,
            ],
            [
                'step_number' => '02',
                'title' => 'Remodel and Renovation',
                'body' => 'Existing surfaces may need removal, and cabinets or walls may need assessment before a new countertop can be measured accurately.',
                'sort_order' => 2,
            ],
            [
                'step_number' => '03',
                'title' => 'Multifamily and Commercial',
                'body' => 'Repeated layouts and larger schedules call for consistent specifications, approved drawings, and coordinated site access.',
                'sort_order' => 3,
            ],
        ] as $step) {
            $guide->steps()->create($step + ['is_active' => true]);
        }

        $guide->materials()->delete();
        foreach ([
            [
                'name' => 'Quartzite Countertops Idaho',
                'body' => 'Quartzite countertops Idaho can introduce dramatic natural movement into an island or vanity. Many true quartzites are notably hard, but individual slabs differ in porosity and composition. It is worth confirming the stone’s identity and maintenance requirements before treating it as a universally stain-resistant surface.',
                'image_path' => '/materials/quartzite.webp',
                'sort_order' => 1,
            ],
            [
                'name' => 'Granite Countertops Idaho',
                'body' => 'Granite countertops Idaho can suit kitchens and other regularly used interior surfaces because many granite varieties offer robust performance and unique mineral patterning. Finishes and porosity vary, however, and some materials benefit from sealing. Compare whole slabs when possible, especially if a large island or several adjoining pieces will make pattern continuity important.',
                'image_path' => '/materials/granite.webp',
                'sort_order' => 2,
            ],
            [
                'name' => 'Marble Countertops Idaho',
                'body' => 'Marble countertops Idaho may be chosen for their luminous appearance and classic movement. Marble is softer than many granite and quartzite varieties, and acids can etch its finish. These characteristics deserve honest discussion, especially in busy kitchens. Bathrooms, powder rooms, and feature areas can offer appealing applications for clients who appreciate natural patina.',
                'image_path' => '/materials/marble.webp',
                'sort_order' => 3,
            ],
            [
                'name' => 'Quartz Countertops Idaho',
                'body' => 'Quartz countertops Idaho offer manufactured consistency, a wide range of patterns, and convenient daily cleaning. Most engineered quartz surfaces are nonporous and do not require routine sealing. They should still be protected from high heat, and product guidance should be reviewed for strong direct sunlight.',
                'image_path' => '/materials/quartz.webp',
                'sort_order' => 4,
            ],
        ] as $material) {
            $guide->materials()->create($material + ['is_active' => true]);
        }

        $guide->faqs()->delete();
        foreach ([
            [
                'question' => 'What is the difference between quartzite, quartz, granite, and marble countertops?',
                'answer' => 'Quartzite, granite, and marble are natural stones, while engineered quartz combines mineral content with binders. They differ in appearance, porosity, heat response, and care requirements.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Which countertop material is the most durable and easiest to maintain?',
                'answer' => 'Engineered quartz is often convenient because it typically requires no sealing. Granite and true quartzite can be very durable, but care varies by slab. No material is entirely maintenance-free.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Do quartzite, granite, and marble countertops need to be sealed?',
                'answer' => 'Some slabs benefit from sealing, but requirements depend on porosity, finish, and product guidance. Sealing helps reduce absorption; it does not make stone stainproof or prevent marble etching.',
                'sort_order' => 3,
            ],
            [
                'question' => 'What are the pros and cons of natural stone versus engineered quartz countertops?',
                'answer' => 'Natural stone offers unique movement and variation but may require sealing. Engineered quartz provides consistent patterns and simpler maintenance, but its resin content limits tolerance for high heat and some sunlight exposure.',
                'sort_order' => 4,
            ],
            [
                'question' => 'How do you clean and maintain quartz, granite, marble, and quartzite countertops?',
                'answer' => 'Use a soft cloth, a mild cleaner suitable for the material, and prompt spill cleanup. Avoid abrasive tools and harsh chemicals; use trivets and follow the supplier’s instructions.',
                'sort_order' => 5,
            ],
        ] as $faq) {
            $guide->faqs()->create($faq + ['is_active' => true]);
        }

        $guide->buttons()->delete();
        foreach ([
            ['section' => 'hero_cta', 'label' => 'Request Project Availability', 'url' => '/contact', 'sort_order' => 1],
            ['section' => 'process_cta', 'label' => 'Explore Services', 'url' => '/services', 'sort_order' => 1],
            ['section' => 'work_cta', 'label' => 'View Our Work', 'url' => '/work', 'sort_order' => 1],
            ['section' => 'advantages_cta', 'label' => 'Start Your Project', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'advantages_cta', 'label' => 'Ask About Service Availability', 'url' => '/contact', 'sort_order' => 2],
            ['section' => 'closing_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'closing_cta', 'label' => 'Visit the Utah Showroom', 'url' => '/contact', 'sort_order' => 2],
        ] as $button) {
            $guide->buttons()->create($button + ['is_active' => true]);
        }
    }

    private function seedColorado(): void
    {
        $guide = ServiceGuide::updateOrCreate(
            ['slug' => 'countertop-installation-colorado'],
            [
                'title' => 'Countertop Installation Colorado',
                'meta_title' => 'Countertop Installation Colorado | Creative Granite & Design',
                'meta_description' => 'Countertop installation for Colorado projects—quartzite, granite, marble, and quartz with custom fabrication. Ask about service availability for your location.',
                'hero_image_path' => '/images/services/commercial-hero.jpg',
                'hero_body' => "Colorado interiors often balance natural textures with clean architectural lines. A stone surface can echo that contrast, but a good decision still begins with the demands of the kitchen, bathroom, or commercial space rather than a passing design trend.\nCreative Granite + Design provides stone fabrication and installation services from its Utah base.",
                'process_eyebrow' => 'Who We Are',
                'process_heading' => 'Stone Fabrication with a Practical Point of View',
                'process_body' => "Established in 1998, Creative Granite + Design works with homeowners, builders, and designers on custom stone surfaces. Our approach connects material selection with fabrication details, including edge profiles, sink openings, seam placement, and installation conditions.\n\nPlanning, Fabrication, and Installation\nFor countertop installation in Colorado, our team can discuss project requirements and confirm whether service arrangements are available for the requested location.",
                'process_image_path' => '/images/services/new-construction-2.jpg',
                'work_eyebrow' => 'Our Work',
                'work_heading' => 'Details That Shape the Finished Room',
                'work_body' => 'An attractive slab is only the beginning. The position of a seam can change how a long island reads, while a backsplash or edge profile can connect the surface to surrounding cabinetry. Review completed work for examples of scale, pattern movement, and finishing details, but remember that natural stone is never perfectly repeatable.',
                'work_image_path' => '/images/work/parade-home-cover.jpg',
                'materials_eyebrow' => 'Materials',
                'materials_heading' => 'Materials to Compare Performance Before Choosing a Pattern',
                'materials_intro' => 'Selecting a countertop should involve more than color. Natural stones vary from slab to slab, while engineered surfaces offer greater pattern consistency. Think about food preparation, spills, cleaning products, sunlight, and the way the material will meet surrounding finishes.',
                'additional_eyebrow' => 'Additional Materials',
                'additional_heading' => 'Additional Materials to Explore the Right Application',
                'additional_body' => 'Porcelain and other special-order surfaces may be available for projects that call for a different look or specific performance characteristics. Product suitability depends on the installation environment and manufacturer requirements.',
                'additional_help_text' => null,
                'additional_image_path' => '/images/services/remodel-3.jpg',
                'advantages_heading' => 'How to Plan a Countertop Project',
                'advantages_body' => 'Begin with a drawing or approximate dimensions, photographs of the existing space, and notes about sinks, appliances, and cabinet conditions. Decide which visual features matter most: a quiet neutral surface, a dramatic natural pattern, or consistent material across several rooms. Then ask for a project-specific estimate that explains the material, fabrication, installation scope, and any travel considerations.',
                'advantages_image_path' => '/images/site/LakeLine-20.jpg',
                'faq_heading' => 'Frequently Asked Questions',
                'cta_heading' => 'Start Your Project to Discuss the Location and the Details',
                'cta_body' => 'If you are considering countertop installation in Colorado, share the project address, approximate square footage, intended material, and anticipated construction schedule. We can help clarify the selection and fabrication questions, then confirm whether installation service is available at the requested Colorado location. Thoughtful planning starts with accurate expectations, not assumptions about travel or turnaround.',
                'sort_order' => 7,
                'is_active' => true,
                'show_in_nav' => false,
                'is_service_area' => true,
            ]
        );

        $guide->steps()->delete();
        foreach ([
            [
                'step_number' => '01',
                'title' => 'Residential and New Construction',
                'body' => 'Kitchens, bathrooms, and new homes benefit from accurate measurements and coordination with cabinetry, plumbing, and project schedules.',
                'sort_order' => 1,
            ],
            [
                'step_number' => '02',
                'title' => 'Remodel and Renovation',
                'body' => 'Existing surfaces may need removal, and cabinets or walls may need assessment before a new countertop can be measured accurately.',
                'sort_order' => 2,
            ],
            [
                'step_number' => '03',
                'title' => 'Multifamily and Commercial',
                'body' => 'Repeated layouts and larger schedules call for consistent specifications, approved drawings, and coordinated site access.',
                'sort_order' => 3,
            ],
        ] as $step) {
            $guide->steps()->create($step + ['is_active' => true]);
        }

        $guide->materials()->delete();
        foreach ([
            [
                'name' => 'Quartzite Countertop Colorado',
                'body' => 'Quartzite countertop Colorado can introduce dramatic natural movement into an island or vanity. Many true quartzites are notably hard, but individual slabs differ in porosity and composition. It is worth confirming the stone’s identity and maintenance requirements before treating it as a universally stain-resistant surface.',
                'image_path' => '/materials/quartzite.webp',
                'sort_order' => 1,
            ],
            [
                'name' => 'Granite Countertop In Colorado',
                'body' => 'Granite countertop in Colorado can suit kitchens and other regularly used interior surfaces because many granite varieties offer robust performance and unique mineral patterning. Finishes and porosity vary, however, and some materials benefit from sealing. Compare whole slabs when possible, especially if a large island or several adjoining pieces will make pattern continuity important.',
                'image_path' => '/materials/granite.webp',
                'sort_order' => 2,
            ],
            [
                'name' => 'Marble Countertop Colorado',
                'body' => 'Marble countertops in Colorado may be chosen for their luminous appearance and classic movement. Marble is softer than many granite and quartzite varieties, and acids can etch its finish. These characteristics deserve honest discussion, especially in busy kitchens. Bathrooms, powder rooms, and feature areas can offer appealing applications for clients who appreciate natural patina.',
                'image_path' => '/materials/marble.webp',
                'sort_order' => 3,
            ],
            [
                'name' => 'Quartz Countertop In Colorado',
                'body' => 'Quartz countertops in Colorado offer manufactured consistency, a wide range of patterns, and convenient daily cleaning. Most engineered quartz surfaces are nonporous and do not require routine sealing. They should still be protected from high heat, and product guidance should be reviewed for strong direct sunlight.',
                'image_path' => '/materials/quartz.webp',
                'sort_order' => 4,
            ],
        ] as $material) {
            $guide->materials()->create($material + ['is_active' => true]);
        }

        $guide->faqs()->delete();
        foreach ([
            [
                'question' => 'What is the difference between natural quartzite and engineered quartz countertops?',
                'answer' => 'Quartzite is a natural metamorphic stone whose characteristics vary by slab. Engineered quartz is manufactured with mineral content and binders, giving it more consistent patterns and generally no need for sealing.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Which countertop materials are best for Colorado kitchens with heavy daily use?',
                'answer' => 'Granite, true quartzite, and engineered quartz are commonly considered. The best choice depends on actual material properties, cleaning habits, exposure, and desired appearance.',
                'sort_order' => 2,
            ],
            [
                'question' => 'How do temperature changes and sunlight affect granite, marble, quartzite, and quartz countertops?',
                'answer' => 'Indoor conditions are usually controlled, but direct sunlight and heat deserve attention. Engineered quartz can be sensitive to prolonged UV exposure and high heat; all materials should be installed according to product guidance.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Can marble countertops stain or etch, and how can these issues be prevented?',
                'answer' => 'Yes. Marble can stain when liquids are absorbed and etch when acids react with its calcium carbonate. An estimate for countertop installation in Colorado should connect the chosen material with the work required to produce and fit it. Clarify which tasks belong to a plumber, electrician, cabinet installer, or general contractor.',
                'sort_order' => 4,
            ],
            [
                'question' => 'How often should granite and quartzite countertops be sealed to maintain their appearance?',
                'answer' => 'There is no universal schedule. The need depends on the slab’s porosity, sealer, and use. Ask for material-specific guidance rather than relying on an automatic annual rule.',
                'sort_order' => 5,
            ],
        ] as $faq) {
            $guide->faqs()->create($faq + ['is_active' => true]);
        }

        $guide->buttons()->delete();
        foreach ([
            ['section' => 'hero_cta', 'label' => 'Request Project Availability', 'url' => '/contact', 'sort_order' => 1],
            ['section' => 'process_cta', 'label' => 'Explore Services', 'url' => '/services', 'sort_order' => 1],
            ['section' => 'work_cta', 'label' => 'View Our Work', 'url' => '/work', 'sort_order' => 1],
            ['section' => 'advantages_cta', 'label' => 'Start Your Project', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'advantages_cta', 'label' => 'Ask About Service Availability', 'url' => '/contact', 'sort_order' => 2],
            ['section' => 'closing_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'closing_cta', 'label' => 'Visit the Utah Showroom', 'url' => '/contact', 'sort_order' => 2],
        ] as $button) {
            $guide->buttons()->create($button + ['is_active' => true]);
        }
    }

    private function seedWyoming(): void
    {
        $guide = ServiceGuide::updateOrCreate(
            ['slug' => 'countertop-installation-in-wyoming'],
            [
                'title' => 'Countertop Installation in Wyoming',
                'meta_title' => 'Countertop Installation in Wyoming | Creative Granite & Design',
                'meta_description' => 'Countertop installation for Wyoming projects—quartzite, granite, marble, and quartz with custom fabrication. Ask about service availability for your location.',
                'hero_image_path' => '/images/work/fireplaces-cover.jpg',
                'hero_body' => 'Wyoming projects may favor substantial natural textures or crisp contemporary finishes, but their everyday demands can be remarkably different. A busy family kitchen, a guest bathroom, and a commercial reception counter should not be specified as though they were the same room. Creative Granite + Design provides stone fabrication and installation services from its Utah base.',
                'process_eyebrow' => 'Who We Are',
                'process_heading' => 'Stone Fabrication with a Practical Point of View',
                'process_body' => "Established in 1998, Creative Granite + Design works with homeowners, builders, and designers on custom stone surfaces. Our approach connects material selection with fabrication details, including edge profiles, sink openings, seam placement, and installation conditions.\n\nPlanning, Fabrication, and Installation",
                'process_image_path' => '/images/services/new-construction-3.jpg',
                'work_eyebrow' => 'Our Work',
                'work_heading' => 'Details That Shape the Finished Room',
                'work_body' => 'An attractive slab is only the beginning. The position of a seam can change how a long island reads, while a backsplash or edge profile can connect the surface to surrounding cabinetry. Review completed work for examples of scale, pattern movement, and finishing details, but remember that natural stone is never perfectly repeatable.',
                'work_image_path' => '/images/work/lancaster-cover.jpg',
                'materials_eyebrow' => 'Materials',
                'materials_heading' => 'Materials to Compare Performance Before Choosing a Pattern',
                'materials_intro' => 'Selecting a countertop should involve more than color. Natural stones vary from slab to slab, while engineered surfaces offer greater pattern consistency. Think about food preparation, spills, cleaning products, sunlight, and the way the material will meet surrounding finishes.',
                'additional_eyebrow' => 'Additional Materials',
                'additional_heading' => 'Additional Materials to Explore the Right Application',
                'additional_body' => 'Porcelain and other special-order surfaces may be available for projects that call for a different look or specific performance characteristics. Product suitability depends on the installation environment and manufacturer requirements.',
                'additional_help_text' => null,
                'additional_image_path' => '/images/services/commercial-2.jpg',
                'advantages_heading' => 'How to Plan a Countertop Project',
                'advantages_body' => 'Begin with a drawing or approximate dimensions, photographs of the existing space, and notes about sinks, appliances, and cabinet conditions. Decide which visual features matter most: a quiet neutral surface, a dramatic natural pattern, or consistent material across several rooms. Then ask for a project-specific estimate that explains the material, fabrication, installation scope, and any travel considerations.',
                'advantages_image_path' => '/images/site/LakeLine-20.jpg',
                'faq_heading' => 'Frequently Asked Questions',
                'cta_heading' => 'Start Your Project Now!',
                'cta_body' => 'If you are considering countertop installation in Wyoming, share the project address, approximate square footage, intended material, and anticipated construction schedule.',
                'sort_order' => 8,
                'is_active' => true,
                'show_in_nav' => false,
                'is_service_area' => true,
            ]
        );

        $guide->steps()->delete();
        foreach ([
            [
                'step_number' => '01',
                'title' => 'Residential and New Construction',
                'body' => 'Kitchens, bathrooms, and new homes benefit from accurate measurements and coordination with cabinetry, plumbing, and project schedules.',
                'sort_order' => 1,
            ],
            [
                'step_number' => '02',
                'title' => 'Remodel and Renovation',
                'body' => 'Existing surfaces may need removal, and cabinets or walls may need assessment before a new countertop can be measured accurately.',
                'sort_order' => 2,
            ],
            [
                'step_number' => '03',
                'title' => 'Multifamily and Commercial',
                'body' => 'Repeated layouts and larger schedules call for consistent specifications, approved drawings, and coordinated site access.',
                'sort_order' => 3,
            ],
        ] as $step) {
            $guide->steps()->create($step + ['is_active' => true]);
        }

        $guide->materials()->delete();
        foreach ([
            [
                'name' => 'Quartzite Countertops Wyoming',
                'body' => 'Quartzite countertops Wyoming can introduce dramatic natural movement into an island or vanity. Many true quartzites are notably hard, but individual slabs differ in porosity and composition. It is worth confirming the stone’s identity and maintenance requirements before treating it as a universally stain-resistant surface.',
                'image_path' => '/materials/quartzite.webp',
                'sort_order' => 1,
            ],
            [
                'name' => 'Granite Countertops Wyoming',
                'body' => 'Granite countertops Wyoming can suit kitchens and other regularly used interior surfaces because many granite varieties offer robust performance and unique mineral patterning. Finishes and porosity vary, however, and some materials benefit from sealing. Compare whole slabs when possible, especially if a large island or several adjoining pieces will make pattern continuity important.',
                'image_path' => '/materials/granite.webp',
                'sort_order' => 2,
            ],
            [
                'name' => 'Marble Countertops Wyoming',
                'body' => 'Marble countertops Wyoming may be chosen for their luminous appearance and classic movement. Marble is softer than many granite and quartzite varieties, and acids can etch its finish. These characteristics deserve honest discussion, especially in busy kitchens. Bathrooms, powder rooms, and feature areas can offer appealing applications for clients who appreciate natural patina.',
                'image_path' => '/materials/marble.webp',
                'sort_order' => 3,
            ],
            [
                'name' => 'Quartz Countertops Wyoming',
                'body' => 'Quartz countertops Wyoming offer manufactured consistency, a wide range of patterns, and convenient daily cleaning. Most engineered quartz surfaces are nonporous and do not require routine sealing. They should still be protected from high heat, and product guidance should be reviewed for strong direct sunlight.',
                'image_path' => '/materials/quartz.webp',
                'sort_order' => 4,
            ],
        ] as $material) {
            $guide->materials()->create($material + ['is_active' => true]);
        }

        $guide->faqs()->delete();
        foreach ([
            [
                'question' => 'What factors affect the lifespan of granite, quartzite, marble, and quartz countertops?',
                'answer' => 'Material characteristics, support, installation quality, cleaning products, impact, heat exposure, and routine care all matter. Proper use can extend the life of any suitable surface.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Are light-colored or dark-colored stone countertops easier to maintain?',
                'answer' => 'Neither is universally easier. Dark polished finishes may reveal fingerprints and water spots, while some pale materials show certain stains more readily. Pattern and finish can matter more than color alone.',
                'sort_order' => 2,
            ],
            [
                'question' => 'What countertop edge profiles are available, and how do they affect the overall design?',
                'answer' => 'Eased, beveled, rounded, and mitered profiles are common possibilities. The choice affects visual weight, comfort, chip exposure, and fabrication requirements.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Can existing countertops be installed over, or should they be completely removed first?',
                'answer' => "Installing new stone over existing counters is not generally assumed appropriate. The underlying structure, support, height, plumbing, and manufacturer guidance must be evaluated; removal is often necessary.\n\nAn estimate for countertop installation in Wyoming should connect the chosen material with the work required to produce and fit it. Ask whether the scope covers templating, slab selection, fabrication, edge details, sink and appliance cutouts, delivery, installation, and any removal work. Clarify which tasks belong to a plumber, electrician, cabinet installer, or general contractor.",
                'sort_order' => 4,
            ],
            [
                'question' => 'What is the difference between prefabricated and custom-fabricated stone countertops?',
                'answer' => 'Prefabricated pieces come in standard dimensions or finishes, while custom fabrication is planned around a specific layout, openings, edges, and slab placement. Complex spaces often benefit from custom work.',
                'sort_order' => 5,
            ],
        ] as $faq) {
            $guide->faqs()->create($faq + ['is_active' => true]);
        }

        $guide->buttons()->delete();
        foreach ([
            ['section' => 'hero_cta', 'label' => 'Request Project Availability', 'url' => '/contact', 'sort_order' => 1],
            ['section' => 'process_cta', 'label' => 'Explore Services', 'url' => '/services', 'sort_order' => 1],
            ['section' => 'work_cta', 'label' => 'View Our Work', 'url' => '/work', 'sort_order' => 1],
            ['section' => 'advantages_cta', 'label' => 'Start Your Project', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'advantages_cta', 'label' => 'Ask About Service Availability', 'url' => '/contact', 'sort_order' => 2],
            ['section' => 'closing_cta', 'label' => 'Get an Estimate', 'url' => '#estimate', 'sort_order' => 1],
            ['section' => 'closing_cta', 'label' => 'Visit the Utah Showroom', 'url' => '/contact', 'sort_order' => 2],
        ] as $button) {
            $guide->buttons()->create($button + ['is_active' => true]);
        }
    }
}
