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
        Schema::create('artist_track', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['primary_artist', 'featured_artist', 'producer', 'writer', 'composer'])->default('primary_artist');
            $table->decimal('royalty_percentage', 5, 2)->default(0);
            $table->timestamps();
            
            $table->unique(['artist_id', 'track_id', 'role']);
            $table->index('artist_id');
            $table->index('track_id');
            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_track');
    }
};