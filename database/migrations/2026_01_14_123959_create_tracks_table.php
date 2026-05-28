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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('duration')->nullable(); // duration in seconds
            $table->integer('track_number')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreignId('album_id')->constrained('albums')->onDelete('cascade');
            $table->foreignId('genre_id')->constrained('genres')->onDelete('cascade')->nullable();
            $table->foreignId('artist_id')->constrained('artists')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
