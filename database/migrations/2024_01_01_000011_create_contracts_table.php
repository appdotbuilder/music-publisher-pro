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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->enum('type', ['recording', 'publishing', 'distribution', 'management'])->default('recording');
            $table->enum('status', ['draft', 'sent', 'signed', 'expired', 'terminated'])->default('draft');
            $table->datetime('sent_at')->nullable();
            $table->datetime('signed_at')->nullable();
            $table->datetime('expires_at')->nullable();
            $table->string('signature_ip')->nullable();
            $table->json('terms')->nullable();
            $table->timestamps();
            
            $table->index('tenant_id');
            $table->index('artist_id');
            $table->index('status');
            $table->index('type');
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};