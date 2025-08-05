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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('upc')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_art_url')->nullable();
            $table->date('release_date')->nullable();
            $table->string('genre')->nullable();
            $table->string('label')->nullable();
            $table->enum('status', ['draft', 'pending', 'distributed', 'failed'])->default('draft');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index('tenant_id');
            $table->index('title');
            $table->index('status');
            $table->index('release_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};