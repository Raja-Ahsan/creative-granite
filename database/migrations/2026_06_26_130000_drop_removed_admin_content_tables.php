<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('process_steps');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('instagram_posts');
        Schema::dropIfExists('navigation_items');
        Schema::dropIfExists('content_sections');
    }

    public function down(): void
    {
        // Tables are restored only via original create migrations on migrate:fresh.
    }
};
