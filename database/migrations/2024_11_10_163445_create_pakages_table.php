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
        Schema::create('pakages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('admin_id');
            $table->string('type')->unique()->index();
            $table->string('name');
            $table->decimal('fixed_charge',8,2,true)->default(0);
            $table->decimal('percent_charge',8,2,true)->default(0);
            $table->decimal('min_limit',8,2,true)->default(0);
            $table->string('state')->default('active');
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakages');
    }
};
