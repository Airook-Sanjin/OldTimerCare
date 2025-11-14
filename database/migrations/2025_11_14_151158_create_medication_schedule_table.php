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
        Schema::create('MedicationSchedule', function (Blueprint $table) {
            $table->id('MedID');
            $table->unsignedBigInteger('HomePageID');
            $table->enum('TimeOfDay', ['Morning','Afternoon','Night']);
            $table->boolean('Taken')->default(false);
            $table->timestamps();

            $table->foreign('HomePageID')->references('HomePageID')->on('HomePage');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_schedule');
    }
};
