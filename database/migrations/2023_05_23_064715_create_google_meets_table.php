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
        Schema::create('google_meets', function (Blueprint $table) {
            $table->id();
            $table->longtext('session_id');
            $table->longtext('token')->nullable();
            $table->longtext('meet_link')->nullable();
            $table->string('created_by')->nullable();
            $table->string('is_session_active')->nullable()->default(0)->comment('0=>deactive,1=>active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_meets');
    }
};
