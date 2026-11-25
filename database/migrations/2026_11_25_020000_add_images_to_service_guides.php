<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_guides', function (Blueprint $table) {
            $table->string('hero_image_path')->nullable()->after('meta_description');
            $table->string('additional_image_path')->nullable()->after('additional_help_text');
            $table->string('advantages_image_path')->nullable()->after('advantages_body');
        });

        Schema::table('service_guide_materials', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('body');
        });
    }

    public function down(): void
    {
        Schema::table('service_guides', function (Blueprint $table) {
            $table->dropColumn(['hero_image_path', 'additional_image_path', 'advantages_image_path']);
        });

        Schema::table('service_guide_materials', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
