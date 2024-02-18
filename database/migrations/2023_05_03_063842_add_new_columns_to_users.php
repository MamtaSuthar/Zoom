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
        Schema::table('users', function (Blueprint $table) {
            $table->string('dob')->nullable();
            $table->string('designation')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('emp_id')->nullable();
            $table->integer('terminated')->default(0)->comment('1->terminated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('dob');
            $table->dropColumn('designation');
            $table->dropColumn('blood_group');
            $table->dropColumn('emp_id');
            $table->dropColumn('terminated');
        });
    }
};
