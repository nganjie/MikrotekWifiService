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
        Schema::table('money_withdrawals', function (Blueprint $table) {
            $table->longText('remark')->after('receiver_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('money_withdrawals', function (Blueprint $table) {
            $table->dropColumn('remark');
        });
    }
};
