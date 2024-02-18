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
        Schema::table('google_meets', function (Blueprint $table) {
            $table->longText('user_id')->nullable()->after('meet_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('google_meets', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
