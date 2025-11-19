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
        Schema::create('Users', function (Blueprint $table) {
            $table->id("UserID");
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('Email')->unique();
            $table->string('Phone');
            $table->string('Address');
            $table->string('Password');
            $table->date('DOB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Users');
    }
};
