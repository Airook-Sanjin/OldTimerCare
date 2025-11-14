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
        Schema::create('Users', function (Blueprint $table) {
            $table->id('UserID');
            $table->string('FirstName', 50);
            $table->string('LastName', 50);
            $table->string('Email', 50)->unique();
            $table->string('Password', 255);
            $table->string('Phone', 15)->nullable();
            $table->string('Address', 100)->nullable();
            $table->date('DateOfBirth')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
