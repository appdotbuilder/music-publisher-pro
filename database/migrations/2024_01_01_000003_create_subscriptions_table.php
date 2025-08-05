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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_plan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['trialing', 'active', 'cancelled', 'expired'])->default('trialing');
            $table->datetime('trial_ends_at')->nullable();
            $table->datetime('ends_at')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_status')->nullable();
            $table->timestamps();
            
            $table->index('tenant_id');
            $table->index('status');
            $table->index('trial_ends_at');
            $table->index('ends_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};