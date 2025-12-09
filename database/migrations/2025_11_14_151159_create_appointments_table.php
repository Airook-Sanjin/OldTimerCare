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
        Schema::create('Appointments', function (Blueprint $table) {
            $table->id('AppointmentID');
            $table->unsignedBigInteger('PatientID');
            $table->unsignedBigInteger('DoctorID');
            $table->unsignedBigInteger('CaregiverID')->nullable();
            $table->date('Date');
            $table->text('Notes')->nullable();
            $table->timestamps();

            $table->foreign('PatientID')->references('PatientID')->on('Patient');
            $table->foreign('DoctorID')->references('EmployeeID')->on('Employee');
            $table->foreign('CaregiverID')->references('EmployeeID')->on('Employee');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Appointments');
    }
};
