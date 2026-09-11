<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('remnants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('material')->nullable();
            $table->string('finish')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('thickness')->nullable();
            $table->string('remnant_code')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->text('description')->nullable();
            $table->string('suitability')->nullable();
            $table->string('price_label')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('remnants');
    }
};
