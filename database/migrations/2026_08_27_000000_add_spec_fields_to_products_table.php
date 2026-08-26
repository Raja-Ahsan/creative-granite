<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('model')->nullable()->after('slug');
            $table->string('material')->nullable()->after('model');
            $table->string('bowl_description')->nullable()->after('material');
            $table->string('mount')->nullable()->after('bowl_description');
            $table->string('gauge')->nullable()->after('mount');
            $table->string('construction')->nullable()->after('gauge');
            $table->string('dimensions')->nullable()->after('construction');
            $table->string('colors_finish')->nullable()->after('dimensions');
            $table->text('optional_accessories')->nullable()->after('colors_finish');
            $table->string('image_path')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'model',
                'material',
                'bowl_description',
                'mount',
                'gauge',
                'construction',
                'dimensions',
                'colors_finish',
                'optional_accessories',
            ]);
            $table->string('image_path')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
        });
    }
};
