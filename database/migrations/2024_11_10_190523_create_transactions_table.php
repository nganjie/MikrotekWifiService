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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_wifi_id');
            $table->unsignedBigInteger('money_withdrawal_id');
            $table->string('type');
            $table->string('status');
            $table->string('receiver_number');
            $table->string('price');
            $table->string('charge')->nullable();
            $table->string('sms_charge')->nullable();
            $table->string('net_price');
            $table->string('vendor_reference')->nullable();
            $table->string('operation_reference')->nullable();
            $table->boolean('is_collected')->default(false);
            $table->timestamps();
            $table->foreign('ticket_wifi_id')->references('id')->on('ticket_wifis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('money_withdrawal_id')->nullable()->references('id')->on('money_withdrawals')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};