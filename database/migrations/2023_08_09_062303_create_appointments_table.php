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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dob');
            $table->string('email');
            $table->string('phone_no');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->boolean('is_new_patient');
            $table->enum('status', ['Pending', 'Approved', 'Cancelled'])->default('Pending');
            $table->datetime('approved_time')->nullable();
            $table->datetime('cancelled_time')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('cancellation_requested_by_patient')->nullable();
            $table->text('cancellation_notes')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('clinic_id')->nullable()->unsigned();   // foreign
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->unsignedBigInteger('approved_by')->nullable()->unsigned();   // foreign
            $table->foreign('approved_by')->references('id')->on('users');
            $table->unsignedBigInteger('cancelled_by')->nullable()->unsigned();   // foreign
            $table->foreign('cancelled_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
