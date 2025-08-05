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
        Schema::create('royalty_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 12, 4);
            $table->integer('plays')->default(0);
            $table->date('period_start');
            $table->date('period_end');
            $table->string('platform')->nullable();
            $table->enum('status', ['pending', 'processed', 'paid'])->default('pending');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index('tenant_id');
            $table->index('track_id');
            $table->index('artist_id');
            $table->index('status');
            $table->index(['period_start', 'period_end']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('royalty_payments');
    }
};