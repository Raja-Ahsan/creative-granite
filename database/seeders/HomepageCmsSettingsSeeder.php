<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Services\SiteContentService;
use Illuminate\Database\Seeder;

/**
 * Inserts missing homepage CMS setting keys only.
 * Existing values are never overwritten.
 */
class HomepageCmsSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'hero_intro_eyebrow', 'value' => 'Welcome to creative granite and design', 'type' => 'string', 'group' => 'hero'],
            ['key' => 'hero_intro_heading', 'value' => "Countertop Installation Salt Lake City, UT —\nCustom Stone for Inspired Spaces", 'type' => 'string', 'group' => 'hero'],
            ['key' => 'hero_intro_subheading', 'value' => 'Serving homeowners, builders, and multifamily projects across Utah', 'type' => 'string', 'group' => 'hero'],
            ['key' => 'hero_intro_button_label', 'value' => 'Get an Estimate', 'type' => 'string', 'group' => 'hero'],
            ['key' => 'hero_intro_button_url', 'value' => '#estimate', 'type' => 'string', 'group' => 'hero'],

            ['key' => 'work_eyebrow', 'value' => 'Our work', 'type' => 'string', 'group' => 'work'],
            ['key' => 'work_heading', 'value' => 'Fabricated with precision. installed with intention.', 'type' => 'string', 'group' => 'work'],
            ['key' => 'work_subheading', 'value' => 'A selection of completed spaces, material details, and in between moments each reflecting our approach to stone, design, and execution.', 'type' => 'string', 'group' => 'work'],

            ['key' => 'materials_help_eyebrow', 'value' => 'Need help choosing?', 'type' => 'string', 'group' => 'materials_section'],
            ['key' => 'materials_help_heading', 'value' => 'Not sure which material is right for your project?', 'type' => 'string', 'group' => 'materials_section'],
            ['key' => 'materials_help_body', 'value' => 'The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.', 'type' => 'string', 'group' => 'materials_section'],
            ['key' => 'materials_help_primary_label', 'value' => 'Start Your Project', 'type' => 'string', 'group' => 'materials_section'],
            ['key' => 'materials_help_primary_url', 'value' => '#estimate', 'type' => 'string', 'group' => 'materials_section'],
            ['key' => 'materials_help_secondary_label', 'value' => 'Visit the Showroom', 'type' => 'string', 'group' => 'materials_section'],
            ['key' => 'materials_help_secondary_url', 'value' => '', 'type' => 'string', 'group' => 'materials_section'],

            ['key' => 'cta_eyebrow', 'value' => 'Final Call to Action', 'type' => 'string', 'group' => 'cta'],
            ['key' => 'cta_heading', 'value' => 'Start your project', 'type' => 'string', 'group' => 'cta'],
            ['key' => 'cta_body', 'value' => "Whether you're building a custom home, planning a remodel, or managing a multifamily or commercial project, our team is here to help bring it to life.", 'type' => 'string', 'group' => 'cta'],
            ['key' => 'cta_button_label', 'value' => 'Get an Estimate', 'type' => 'string', 'group' => 'cta'],
            ['key' => 'cta_button_url', 'value' => '#estimate', 'type' => 'string', 'group' => 'cta'],
            ['key' => 'cta_showroom_label', 'value' => 'Visit our showroom', 'type' => 'string', 'group' => 'cta'],
            ['key' => 'cta_appointment_label', 'value' => 'Or book an appointment', 'type' => 'string', 'group' => 'cta'],
            ['key' => 'cta_appointment_url', 'value' => '/contact', 'type' => 'string', 'group' => 'cta'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::query()->firstOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                ]
            );
        }

        SiteContentService::clearCache();
    }
}
