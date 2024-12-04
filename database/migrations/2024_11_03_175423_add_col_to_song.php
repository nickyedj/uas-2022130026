<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->foreignId('artist_id')->nullable()->constrained();
            $table->foreignId('album_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['artist_id']);
            $table->dropColumn('artist_id');
            $table->dropForeign(['album_id']);
            $table->dropColumn('album_id');
        });
    }
};
