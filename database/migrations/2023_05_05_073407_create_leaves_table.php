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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->longtext('reason');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('leave_type');
            $table->unsignedBigInteger('applied_user_id');
            $table->integer('status')->default(0)->comment('0->pending, 1->approved, 2->rejected');
            $table->integer('mark')->default(0)->comment('0->unread, 1->read');
            $table->integer('authorizer_user_id')->default(0);
            $table->timestamps();
            $table->foreign('applied_user_id')->references('id')->on('users')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
