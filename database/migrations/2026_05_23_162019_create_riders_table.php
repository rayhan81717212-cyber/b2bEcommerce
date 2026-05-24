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
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('status')->default('active'); 
            $table->timestamps();
        });
        Schema::create('deliveries', function (Blueprint $table) {
        $table->id();
        $table->integer('order_id');
        $table->integer('rider_id')->nullable();
        $table->string('status')->default('pending');
        $table->timestamp('assigned_at')->nullable();
        $table->timestamp('delivered_at')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riders');
    }
};
