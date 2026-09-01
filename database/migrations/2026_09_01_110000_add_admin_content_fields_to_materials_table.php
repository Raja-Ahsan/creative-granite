<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->string('why_choose_heading')->nullable()->after('why_choose');
            $table->string('cta_eyebrow')->nullable()->after('meta_description');
            $table->string('cta_heading')->nullable()->after('cta_eyebrow');
            $table->text('cta_body')->nullable()->after('cta_heading');
            $table->string('cta_primary_label')->nullable()->after('cta_body');
            $table->string('cta_secondary_label')->nullable()->after('cta_primary_label');
            $table->string('cta_secondary_url')->nullable()->after('cta_secondary_label');
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn([
                'why_choose_heading',
                'cta_eyebrow',
                'cta_heading',
                'cta_body',
                'cta_primary_label',
                'cta_secondary_label',
                'cta_secondary_url',
            ]);
        });
    }
};
