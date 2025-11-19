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
        Schema::create('FamilyMember', function (Blueprint $table) {
            $table->id('FamilyMemberID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('PatientID');

            $table->enum('Relationship', [
                'Spouse',
                'Son',
                'Daughter',
                'Brother',
                'Sister',
                'Niece',
                'Nephew',
                'Friend'
            ]);

            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('Users');
            $table->foreign('PatientID')->references('PatientID')->on('Patient');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_member');
    }
};
