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
        Schema::create('Employees', function (Blueprint $table) {
            $table->id("EmployeeID");
            $table->foreignId('UserID');
            $table->foreignId('RoleID');
            $table->date('HireDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Employees');
    }
};
