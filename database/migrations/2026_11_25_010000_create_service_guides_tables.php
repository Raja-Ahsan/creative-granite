<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_guides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('materials_eyebrow')->nullable();
            $table->string('materials_heading')->nullable();
            $table->text('materials_intro')->nullable();
            $table->string('additional_eyebrow')->nullable();
            $table->string('additional_heading')->nullable();
            $table->text('additional_body')->nullable();
            $table->text('additional_help_text')->nullable();
            $table->string('advantages_heading')->nullable();
            $table->text('advantages_body')->nullable();
            $table->string('faq_heading')->nullable();
            $table->string('cta_heading')->nullable();
            $table->text('cta_body')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_nav')->default(true);
            $table->timestamps();
        });

        Schema::create('service_guide_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_guide_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('body');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('service_guide_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_guide_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->text('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('service_guide_buttons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_guide_id')->constrained()->cascadeOnDelete();
            $table->string('section', 40);
            $table->string('label');
            $table->string('url', 500);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_guide_buttons');
        Schema::dropIfExists('service_guide_faqs');
        Schema::dropIfExists('service_guide_materials');
        Schema::dropIfExists('service_guides');
    }
};
