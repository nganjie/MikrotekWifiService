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
        Schema::create('ticket_wifis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zone_wifi_id');
            $table->string('username');
            $table->string('password');
            $table->string('profile')->nullable();
            $table->string('time_limit')->nullable();
            $table->string('data_limit')->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->foreign('zone_wifi_id')->references('id')->on('zone_wifis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_wifis');
    }
};
