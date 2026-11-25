<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_guides', function (Blueprint $table) {
            $table->text('hero_body')->nullable()->after('hero_image_path');
            $table->string('process_eyebrow')->nullable()->after('hero_body');
            $table->string('process_heading')->nullable()->after('process_eyebrow');
            $table->text('process_body')->nullable()->after('process_heading');
            $table->string('process_image_path')->nullable()->after('process_body');
            $table->string('work_eyebrow')->nullable()->after('process_image_path');
            $table->string('work_heading')->nullable()->after('work_eyebrow');
            $table->text('work_body')->nullable()->after('work_heading');
            $table->string('work_image_path')->nullable()->after('work_body');
        });

        Schema::create('service_guide_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_guide_id')->constrained()->cascadeOnDelete();
            $table->string('step_number', 10)->nullable();
            $table->string('title');
            $table->text('body')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_guide_steps');

        Schema::table('service_guides', function (Blueprint $table) {
            $table->dropColumn([
                'hero_body',
                'process_eyebrow',
                'process_heading',
                'process_body',
                'process_image_path',
                'work_eyebrow',
                'work_heading',
                'work_body',
                'work_image_path',
            ]);
        });
    }
};
