<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MaterialDetailSeeder extends Seeder
{
    private function defaultCta(): array
    {
        return [
            'cta_eyebrow' => 'Need help choosing?',
            'cta_heading' => 'Not sure which material is right for your project?',
            'cta_body' => 'The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.',
            'cta_primary_label' => 'Get an Estimate',
            'cta_secondary_label' => 'Contact Us',
            'cta_secondary_url' => '/contact',
        ];
    }

    public function run(): void
    {
        $materials = [
            [
                'name' => 'Marble',
                'slug' => 'marble',
                'sort_order' => 3,
                'description' => 'A natural stone known for soft movement and timeless appeal, often used in bathrooms and feature areas.',
                'image_path' => '/materials/marble.webp',
                'tagline' => 'Natural beauty with centuries of history',
                'intro' => 'Marble is a natural stone celebrated for its distinctive veining, depth, and timeless character. No two slabs are exactly alike, making it a beautiful choice for spaces where the material itself is meant to become part of the design.',
                'why_choose' => [
                    'One-of-a-kind natural veining and variation',
                    'Available in subtle, classic patterns as well as dramatic statement stones',
                    'Naturally heat resistant',
                    'Develops character and patina over time',
                    'Beautiful for countertops, vanities, fireplaces, walls, and other architectural applications',
                ],
                'what_to_know' => 'Marble is naturally porous and can be more susceptible to staining, scratching, and etching from acidic substances than some other surfaces. Sealing and proper care help protect the stone, but clients choosing marble should be comfortable with the natural evolution of the material over time.',
                'best_for' => 'Clients who prioritize natural character, movement, and timeless design and are comfortable with a surface that may develop a patina.',
                'care_guide_label' => 'Natural Stone Care + Cleaning Guide',
                'care_guide_url' => '/downloads/natural-stone-care-guide.pdf',
                'meta_title' => 'Marble Countertops Utah | Natural Marble Surfaces',
                'meta_description' => 'Explore marble countertops and architectural surfaces in Utah. Learn about natural veining, care, and whether marble is right for your kitchen, bath, or feature space.',
            ],
            [
                'name' => 'Quartzite',
                'slug' => 'quartzite',
                'sort_order' => 4,
                'description' => 'A natural stone valued for durability and distinctive movement, ideal for kitchens and high-traffic spaces.',
                'image_path' => '/materials/quartzite.webp',
                'tagline' => 'Natural stone with beauty and strength',
                'intro' => 'Quartzite is a natural stone known for combining striking movement with impressive durability. Its veining and coloration can create the appearance of marble while offering performance characteristics that make many quartzites well suited for hardworking spaces.',
                'why_choose' => [
                    'Naturally occurring and completely unique from slab to slab',
                    'Often features dramatic veining, movement, and depth',
                    'Generally highly durable and scratch resistant',
                    'Naturally heat resistant',
                    'Works beautifully across kitchens, bathrooms, fireplaces, walls, and statement applications',
                ],
                'what_to_know' => 'Because quartzite is a natural stone, characteristics including porosity, hardness, and maintenance needs can vary between specific materials. Proper sealing and care may be recommended depending on the stone.',
                'best_for' => 'Clients looking for the individuality of natural stone with an emphasis on durability and performance.',
                'care_guide_label' => 'Natural Stone Care + Cleaning Guide',
                'care_guide_url' => '/downloads/natural-stone-care-guide.pdf',
                'meta_title' => 'Quartzite Countertops Utah | Durable Natural Stone',
                'meta_description' => 'Discover quartzite countertops in Utah — natural stone with marble-like beauty and strong everyday performance for kitchens, baths, and feature applications.',
            ],
            [
                'name' => 'Granite',
                'slug' => 'granite',
                'sort_order' => 1,
                'description' => 'A durable natural stone known for its strength and variation. A reliable choice for kitchens and high-use surfaces.',
                'image_path' => '/materials/granite.webp',
                'tagline' => 'Proven performance. Naturally unique.',
                'intro' => 'Granite has remained a trusted surface material for good reason. This natural stone offers excellent durability while providing tremendous variety in color, pattern, texture, and movement.',
                'why_choose' => [
                    'Strong and durable for everyday use',
                    'Naturally heat resistant',
                    'Wide range of colors and patterns',
                    'Every slab has its own natural variation',
                    'Suitable for kitchens, bathrooms, fireplaces, and many other applications',
                    'Relatively straightforward maintenance with proper care',
                ],
                'what_to_know' => 'Like other natural stones, granite is porous to varying degrees and may require periodic sealing. Individual varieties can differ in composition and appearance, so seeing and selecting the actual slab is an important part of the process.',
                'best_for' => 'Clients wanting a durable natural surface with extensive design possibilities and relatively easy maintenance.',
                'care_guide_label' => 'Natural Stone Care + Cleaning Guide',
                'care_guide_url' => '/downloads/natural-stone-care-guide.pdf',
                'meta_title' => 'Granite Countertops Utah | Custom Granite Surfaces',
                'meta_description' => 'Explore granite countertops in Utah. Durable natural stone with extensive color and pattern options for kitchens, baths, fireplaces, and more.',
            ],
            [
                'name' => 'Quartz',
                'slug' => 'quartz',
                'sort_order' => 2,
                'description' => 'An engineered surface designed for consistency and low maintenance, offering a wide range of colors and styles.',
                'image_path' => '/materials/quartz.webp',
                'tagline' => 'Consistent design with everyday ease',
                'intro' => 'Quartz is an engineered surface designed to provide durability, consistency, and low-maintenance performance. Because its appearance is manufactured rather than naturally occurring, quartz offers more predictability in color and pattern from slab to slab.',
                'why_choose' => [
                    'Nonporous and resistant to everyday staining',
                    'Does not require sealing',
                    'Easy to clean and maintain',
                    'Broad range of colors and patterns',
                    'More consistent appearance than natural stone',
                    'Available in designs ranging from subtle and minimal to dramatic veining',
                ],
                'what_to_know' => 'Unlike natural stone, quartz contains resins and should be protected from excessive heat. Trivets or heat protection should be used beneath hot cookware. Because quartz is engineered, it also won\'t have the same natural variation found in marble, granite, or quartzite.',
                'best_for' => 'Clients who value low maintenance, consistency, and a wide range of design options.',
                'care_guide_label' => 'Quartz Care + Cleaning Guide',
                'care_guide_url' => '/downloads/quartz-care-guide.pdf',
                'meta_title' => 'Quartz Countertops Utah | Engineered Quartz Surfaces',
                'meta_description' => 'Learn about quartz countertops in Utah — low-maintenance engineered surfaces with consistent color, easy care, and a wide range of design options.',
            ],
            [
                'name' => 'Additional Materials',
                'slug' => 'additional-materials',
                'sort_order' => 5,
                'description' => 'Porcelain and other specialty surfaces available by request for projects that need something beyond the core collection.',
                'image_path' => '/materials/granite.webp',
                'tagline' => 'Beyond the Core Collection',
                'intro' => 'Creative Granite + Design also works with porcelain and can special order additional surface materials based on the needs of the project. If a client is looking for a specific material or application, our team can help explore available options.',
                'why_choose' => [
                    'Porcelain surfaces for modern, high-performance applications',
                    'Special-order materials based on project requirements',
                    'Guidance from our team on suitability and availability',
                    'Support for unique design directions and custom applications',
                ],
                'what_to_know' => 'Availability, lead times, and performance characteristics can vary by material. Our team can help review options and determine what makes sense for your specific project.',
                'best_for' => 'Clients exploring porcelain, specialty surfaces, or materials outside the core stone collection.',
                'care_guide_label' => null,
                'care_guide_url' => null,
                'meta_title' => 'Additional Surface Materials | Creative Granite Utah',
                'meta_description' => 'Explore porcelain and specialty surface materials available through Creative Granite + Design in Utah. Custom options for unique projects.',
            ],
        ];

        foreach ($materials as $data) {
            Material::updateOrCreate(
                ['slug' => $data['slug']],
                $data + $this->defaultCta() + [
                    'is_active' => true,
                    'is_featured' => $data['sort_order'] <= 2,
                ]
            );
        }
    }
}
