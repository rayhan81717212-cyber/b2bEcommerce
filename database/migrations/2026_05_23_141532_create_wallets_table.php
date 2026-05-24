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
        // 1. wallets
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->timestamps();
        });

        // 2. wallet_transactions
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 15, 2);
            $table->enum('source', ['order', 'refund', 'commission', 'withdraw', 'admin']);
            $table->string('reference_id')->nullable(); 
            $table->text('note')->nullable();
            $table->string('status')->default('success'); 
            $table->timestamp('created_at')->useCurrent();
        });

        // 3. loyalty_points
        Schema::create('loyalty_points', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->unsignedInteger('points')->default(0);
            $table->timestamps();
        });

        // 4. loyalty_transactions
        Schema::create('loyalty_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->unsignedInteger('points');
            $table->enum('type', ['earn', 'redeem']);
            $table->enum('source', ['order', 'referral']);
            $table->string('reference_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_transactions');
        Schema::dropIfExists('loyalty_points');
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('wallets');
    }
};