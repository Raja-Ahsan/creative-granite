<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('image_path');
            $table->boolean('is_featured')->default(false)->after('sort_order');
            $table->boolean('is_active')->default(true)->after('is_featured');
        });

        $items = DB::table('portfolio_items')->orderBy('id')->get(['id']);
        foreach ($items as $index => $item) {
            DB::table('portfolio_items')->where('id', $item->id)->update([
                'sort_order' => $index + 1,
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropColumn(['sort_order', 'is_featured', 'is_active']);
        });
    }
};
