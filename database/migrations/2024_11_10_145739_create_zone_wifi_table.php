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
        Schema::create('zone_wifis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name');
            $table->string('captive_gate');
            $table->longText('description')->nullable();
            $table->longText('image')->nullable();
            $table->string('city')->nullable();
            $table->longText('message')->nullable();
            $table->boolean('is_active_sms')->default(true);
            $table->double('wallet',8,2,true)->default(0);
            $table->string('state')->default('active');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zone_wifis');
    }
};
