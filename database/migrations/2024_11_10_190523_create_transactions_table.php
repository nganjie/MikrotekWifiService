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
            $table->uuid('id')->primary();
            $table->uuid('ticket_wifi_id');
            $table->uuid('money_withdrawal_id')->nullable();
            $table->string('type');
            $table->string('status');
            $table->string('receiver_number')->nullable();
            $table->decimal('price',8,2,true);
            $table->string('charge')->nullable();
            $table->string('sms_charge')->nullable();
            $table->decimal('net_price',8,2,true)->nullable();
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
