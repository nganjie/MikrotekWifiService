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
        Schema::table('pakage_users', function (Blueprint $table) {
            $table->boolean('is_send_message')->default(false)->after('pakage_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pakage_users', function (Blueprint $table) {
            $table->dropColumn('is_send_message');
        });
    }
};
