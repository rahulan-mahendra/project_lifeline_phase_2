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
        Schema::create('open_hours', function (Blueprint $table) {
            $table->id();
            $table->string('day')->nullable();
            $table->integer('day_index')->nullable();
            $table->boolean('is_open')->nullable();
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
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
        Schema::dropIfExists('open_hours');
    }
};
