<?php

use App\Enum\PayementGatewayTypeEnum;
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
        Schema::create('payement_gateways', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('name',[
                PayementGatewayTypeEnum::CINETPAY->label(),
                PayementGatewayTypeEnum::CAMPAY->label()
            ]);
            $table->boolean('is_active')->default(false);
            $table->longText('site_id');
            $table->longText('secret_key');
            $table->longText('api_key');
            $table->longText('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payement_gateways');
    }
};
