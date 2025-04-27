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
        Schema::table('pakages', function (Blueprint $table) {
            $table->decimal('sms_charge')->after('percent_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pakages', function (Blueprint $table) {
            $table->dropColumn('sms_charge');
        });
    }
};
