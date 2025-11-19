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
        Schema::create('Family_members', function (Blueprint $table) {
            $table->id('FamilyMemberID');
            $table->foreignid('PatientID');
            $table->foreignId('UserID');
            $table->enum('Relationship',['Partner','Son','Daughter','Brother','Sister','Niece','Nephew']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Family_members');
    }
};
