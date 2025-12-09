<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable("EmployeeSchedules")){
        Schema::create('EmployeeSchedules', function (Blueprint $table) {
            $table->id('EDIS');
            $table->unsignedBigInteger('EmployeeID');
            $table->unsignedBigInteger('PatientID');
            $table->date('Date');
            $table->unsignedBigInteger('TimeslotId');
            $table->text('Notes')->nullable();
            $table->timestamps();

            $table->foreign('EmployeeID')->references('EmployeeID')->on('Employee');
            $table->foreign('PatientID')->references('PatientID')->on('Patient');
            $table->foreign('TimeslotId')->references('TimeslotId')->on('Timeslots');
        });
        }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('EmployeeSchedules');  
    }
};
