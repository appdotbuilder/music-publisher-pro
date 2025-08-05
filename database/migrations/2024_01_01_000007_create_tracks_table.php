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
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('album_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->string('isrc')->nullable();
            $table->integer('duration_seconds')->nullable();
            $table->integer('track_number')->nullable();
            $table->string('genre')->nullable();
            $table->string('audio_file_url')->nullable();
            $table->text('lyrics')->nullable();
            $table->json('metadata')->nullable();
            $table->enum('status', ['draft', 'pending', 'distributed', 'failed'])->default('draft');
            $table->integer('play_count')->default(0);
            $table->decimal('revenue', 12, 4)->default(0);
            $table->timestamps();
            
            $table->index('tenant_id');
            $table->index('album_id');
            $table->index('title');
            $table->index('status');
            $table->index('play_count');
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