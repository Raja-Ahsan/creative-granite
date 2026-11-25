<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceGuide extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'hero_image_path',
        'hero_body',
        'process_eyebrow',
        'process_heading',
        'process_body',
        'process_image_path',
        'work_eyebrow',
        'work_heading',
        'work_body',
        'work_image_path',
        'materials_eyebrow',
        'materials_heading',
        'materials_intro',
        'additional_eyebrow',
        'additional_heading',
        'additional_body',
        'additional_help_text',
        'additional_image_path',
        'advantages_heading',
        'advantages_body',
        'advantages_image_path',
        'faq_heading',
        'cta_heading',
        'cta_body',
        'sort_order',
        'is_active',
        'show_in_nav',
        'is_service_area',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'show_in_nav' => 'boolean',
            'is_service_area' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function materials(): HasMany
    {
        return $this->hasMany(ServiceGuideMaterial::class)->orderBy('sort_order')->orderBy('id');
    }

    public function steps(): HasMany
    {
        return $this->hasMany(ServiceGuideStep::class)->orderBy('sort_order')->orderBy('id');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ServiceGuideFaq::class)->orderBy('sort_order')->orderBy('id');
    }

    public function buttons(): HasMany
    {
        return $this->hasMany(ServiceGuideButton::class)->orderBy('sort_order')->orderBy('id');
    }

    public function toFrontendPayload(): array
    {
        $activeMaterials = $this->materials->where('is_active', true)->values();
        $activeSteps = $this->steps->where('is_active', true)->values();
        $activeFaqs = $this->faqs->where('is_active', true)->values();
        $activeButtons = $this->buttons->where('is_active', true)->values();

        $mapButtons = fn (string $section) => $activeButtons
            ->where('section', $section)
            ->values()
            ->map(fn (ServiceGuideButton $button) => [
                'label' => $button->label,
                'url' => $button->url,
            ])->all();

        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'metaTitle' => $this->meta_title,
            'metaDescription' => $this->meta_description,
            'heroImage' => $this->hero_image_path,
            'heroBody' => $this->hero_body,
            'heroButtons' => $mapButtons('hero_cta'),
            'processEyebrow' => $this->process_eyebrow,
            'processHeading' => $this->process_heading,
            'processBody' => $this->process_body,
            'processImage' => $this->process_image_path,
            'processSteps' => $activeSteps->map(fn (ServiceGuideStep $step) => [
                'number' => $step->step_number,
                'title' => $step->title,
                'body' => $step->body,
            ])->all(),
            'processButtons' => $mapButtons('process_cta'),
            'workEyebrow' => $this->work_eyebrow,
            'workHeading' => $this->work_heading,
            'workBody' => $this->work_body,
            'workImage' => $this->work_image_path,
            'workButtons' => $mapButtons('work_cta'),
            'materialsEyebrow' => $this->materials_eyebrow,
            'materialsHeading' => $this->materials_heading,
            'materialsIntro' => $this->materials_intro,
            'materials' => $activeMaterials->map(fn (ServiceGuideMaterial $item) => [
                'name' => $item->name,
                'body' => $item->body,
                'image' => $item->image_path,
            ])->all(),
            'additionalEyebrow' => $this->additional_eyebrow,
            'additionalHeading' => $this->additional_heading,
            'additionalBody' => $this->additional_body,
            'additionalHelpText' => $this->additional_help_text,
            'additionalImage' => $this->additional_image_path,
            'additionalButtons' => $mapButtons('materials_cta'),
            'advantagesHeading' => $this->advantages_heading,
            'advantagesBody' => $this->advantages_body,
            'advantagesImage' => $this->advantages_image_path,
            'advantagesButtons' => $mapButtons('advantages_cta'),
            'faqHeading' => $this->faq_heading,
            'faqs' => $activeFaqs->map(fn (ServiceGuideFaq $faq) => [
                'question' => $faq->question,
                'answer' => $faq->answer,
            ])->all(),
            'ctaHeading' => $this->cta_heading,
            'ctaBody' => $this->cta_body,
            'ctaButtons' => $mapButtons('closing_cta'),
        ];
    }
}
