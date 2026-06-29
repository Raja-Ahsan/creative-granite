<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropForeign(['material_id']);
            $table->dropColumn([
                'material_id',
                'tag',
                'material_type',
                'location',
                'sort_order',
                'is_featured',
                'is_active',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->foreignId('material_id')->nullable()->after('id')->constrained('materials')->nullOnDelete();
            $table->string('tag')->nullable()->after('image_path');
            $table->string('material_type')->nullable()->after('tag');
            $table->string('location')->nullable()->after('material_type');
            $table->unsignedInteger('sort_order')->default(0)->after('location');
            $table->boolean('is_featured')->default(false)->after('sort_order');
            $table->boolean('is_active')->default(true)->after('is_featured');
        });
    }
};
