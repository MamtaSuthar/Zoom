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
        Schema::table('zooms', function (Blueprint $table) {
            $table->string('user_id')->nullable()->after('data');
            $table->string('api_uid')->nullable()->after('data');
            $table->string('created_by')->nullable()->after('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zooms', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('api_uid');
            $table->dropColumn('created_by');
        });
    }
};
