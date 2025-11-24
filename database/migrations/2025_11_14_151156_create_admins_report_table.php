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
        Schema::create('AdminsReport', function (Blueprint $table) {
            $table->id('AdminID');
            $table->unsignedBigInteger('EmployeeID');
            $table->unsignedBigInteger('RosterID');
            $table->timestamps();

            $table->foreign('EmployeeID')->references('EmployeeID')->on('Employee');
            $table->foreign('RosterID')->references('RosterID')->on('Roster');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins_report');
    }
};
