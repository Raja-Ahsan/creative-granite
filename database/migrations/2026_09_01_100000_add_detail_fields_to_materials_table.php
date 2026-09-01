<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->string('tagline')->nullable()->after('description');
            $table->text('intro')->nullable()->after('tagline');
            $table->json('why_choose')->nullable()->after('intro');
            $table->text('what_to_know')->nullable()->after('why_choose');
            $table->text('best_for')->nullable()->after('what_to_know');
            $table->string('care_guide_url')->nullable()->after('best_for');
            $table->string('care_guide_label')->nullable()->after('care_guide_url');
            $table->string('meta_title')->nullable()->after('care_guide_label');
            $table->string('meta_description', 500)->nullable()->after('meta_title');
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn([
                'tagline',
                'intro',
                'why_choose',
                'what_to_know',
                'best_for',
                'care_guide_url',
                'care_guide_label',
                'meta_title',
                'meta_description',
            ]);
        });
    }
};
