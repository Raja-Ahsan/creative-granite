<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('number_label', 10)->default('01');
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('hero_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('service_page_section_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_page_section_id')
                ->constrained('service_page_sections')
                ->cascadeOnDelete();
            $table->string('image_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['service_page_section_id', 'sort_order'], 'sps_images_section_sort_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_page_section_images');
        Schema::dropIfExists('service_page_sections');
    }
};
