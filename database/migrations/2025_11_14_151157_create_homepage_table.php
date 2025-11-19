<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('HomePage', function (Blueprint $table) {
            $table->id('HomePageID');
            $table->unsignedBigInteger('PatientID');
            $table->timestamps();

            $table->foreign('PatientID')->references('PatientID')->on('Patient');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage');
    }
};
