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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->string('status')->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreignId('album_id')->constrained('albums')->onDelete('cascade')->nullable();
            $table->foreignId('track_id')->constrained('tracks')->onDelete('cascade')->nullable();
            $table->foreignId('artist_id')->constrained('artists')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
