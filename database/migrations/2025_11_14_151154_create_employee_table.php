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
        Schema::create('Employee', function (Blueprint $table) {
            $table->id('EmployeeID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('RoleID');
            $table->date('HireDate')->nullable();
            $table->timestamps();
            $table->decimal('Salary', 10, 2)->nullable();

            $table->foreign('UserID')->references('UserID')->on('Users');
            $table->foreign('RoleID')->references('RoleID')->on('Role');
            
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('PRAGMA foreign_keys=OFF');
        Schema::dropIfExists('Employee');
        DB::statement('PRAGMA foreign_keys=ON');
    }
};
