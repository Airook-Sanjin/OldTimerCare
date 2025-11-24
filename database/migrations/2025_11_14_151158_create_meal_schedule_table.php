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
        Schema::create('MealSchedule', function (Blueprint $table) {
            $table->id('MealID');
            $table->unsignedBigInteger('HomePageID');
            $table->enum('MealType', ['Breakfast','Lunch','Dinner']);
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
        Schema::dropIfExists('meal_schedule');
    }
};
