<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('remnants', function (Blueprint $table) {
            $table->string('availability_status', 32)->default('available')->after('is_available');
        });

        if (Schema::hasTable('remnants')) {
            DB::table('remnants')->where('is_available', true)->update(['availability_status' => 'available']);
            DB::table('remnants')->where('is_available', false)->update(['availability_status' => 'coming_soon']);
        }
    }

    public function down(): void
    {
        Schema::table('remnants', function (Blueprint $table) {
            $table->dropColumn('availability_status');
        });
    }
};
