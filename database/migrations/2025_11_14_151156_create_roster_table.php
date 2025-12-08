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
    public function up()
    {
        Schema::create('Roster', function (Blueprint $table) {
            $table->id('RosterID');
            $table->unsignedBigInteger('SupervisorID');
            $table->unsignedBigInteger('EmployeeID');
            $table->unsignedBigInteger('PatientID');
            $table->date('ShiftDate');
            $table->enum('ShiftType', ['Morning','Afternoon','Night']);
            $table->timestamps();

            $table->foreign('SupervisorID')->references('EmployeeID')->on('Employee');
            $table->foreign('EmployeeID')->references('EmployeeID')->on('Employee');
            $table->foreign('PatientID')->references('PatientID')->on('Patient');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('PRAGMA foreign_keys=OFF');
        Schema::dropIfExists('Roster');
        DB::statement('PRAGMA foreign_keys=ON');
    }
};
