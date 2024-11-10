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
        Schema::create('captive_portals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zone_wifi_id');
            $table->json('code')->nullable();
            $table->timestamps();
            $table->foreign('zone_wifi_id')->references('id')->on('zone_wifis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captive_portals');
    }
};
