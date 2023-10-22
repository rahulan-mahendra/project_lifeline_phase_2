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
        Schema::create('clinic_alerts', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('clinic_id')->nullable()->unsigned();   // foreign
            $table->foreign('clinic_id')->references('id')->on('clinics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_alerts');
    }
};
