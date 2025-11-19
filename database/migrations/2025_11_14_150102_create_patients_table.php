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
        Schema::create('Patients', function (Blueprint $table) {
            $table->id('PatientID');
            $table->foreignId('UserID');
            $table->foreignId('DoctorID');
            $table->foreignId('CaregiverID');
            $table->double('Total',10,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Patients');
    }
};
