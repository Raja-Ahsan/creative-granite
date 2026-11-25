<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'faq_eyebrow'],
            ['value' => 'FAQ', 'type' => 'string', 'group' => 'faq']
        );
        SiteSetting::updateOrCreate(
            ['key' => 'faq_heading'],
            ['value' => 'Frequently asked questions', 'type' => 'string', 'group' => 'faq']
        );
        SiteSetting::updateOrCreate(
            ['key' => 'faq_subheading'],
            [
                'value' => 'Answers to common questions about materials, timelines, and working with our team.',
                'type' => 'string',
                'group' => 'faq',
            ]
        );

        $items = [
            [
                'question' => 'How long does a typical countertop project take?',
                'answer' => 'Most residential projects move from template to install in about 1–3 weeks, depending on material availability and project complexity. We will confirm a clear timeline during your estimate.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Do you help with material selection?',
                'answer' => 'Yes. Visit our showroom and our team will walk you through granite, quartz, marble, quartzite, and other options based on your design, budget, and how the surface will be used.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Do you offer fabrication for remodels and new construction?',
                'answer' => 'We work with homeowners, builders, designers, and multifamily teams across Utah on both remodel and new construction projects.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Can I use remnants for smaller projects?',
                'answer' => 'Absolutely. Remnants are a great fit for vanities, laundry rooms, and smaller surfaces. Ask our team about current availability.',
                'sort_order' => 4,
            ],
            [
                'question' => 'How do I get an estimate?',
                'answer' => 'Request an estimate online, call our showroom, or book an appointment. We will review your project details and help you choose the right next step.',
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            Faq::updateOrCreate(
                ['question' => $item['question']],
                [
                    'answer' => $item['answer'],
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
