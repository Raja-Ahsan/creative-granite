<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_album_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_album_id')->constrained('gallery_albums')->cascadeOnDelete();
            $table->string('image_path');
            $table->string('alt_text')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['gallery_album_id', 'sort_order']);
        });

        // Allow albums without a single legacy collage file.
        DB::statement('ALTER TABLE gallery_albums MODIFY gallery_path VARCHAR(255) NULL');

        // Move existing single collage images into the new multi-image table.
        $albums = DB::table('gallery_albums')->whereNotNull('gallery_path')->get(['id', 'gallery_path', 'title']);
        foreach ($albums as $album) {
            if (! $album->gallery_path) {
                continue;
            }

            $exists = DB::table('gallery_album_images')
                ->where('gallery_album_id', $album->id)
                ->exists();

            if ($exists) {
                continue;
            }

            DB::table('gallery_album_images')->insert([
                'gallery_album_id' => $album->id,
                'image_path' => $album->gallery_path,
                'alt_text' => $album->title.' collage',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_album_images');
    }
};
