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
        Schema::create('Patient', function (Blueprint $table) {
            $table->id('PatientID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('DoctorID');
            $table->unsignedBigInteger('CaregiverID');
            $table->decimal('Total', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('Users');
            $table->foreign('DoctorID')->references('EmployeeID')->on('Employee');
            $table->foreign('CaregiverID')->references('EmployeeID')->on('Employee');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};
