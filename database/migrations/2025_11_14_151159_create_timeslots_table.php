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
    public function up(): void
    {
        Schema::create('Timeslots', function (Blueprint $table) {
            $table->id('TimeslotId');
            $table->text('label');
            $table->text('start_time');
            $table->text('end_time');
            $table->timestamps();
        }); 
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('PRAGMA foreign_keys=OFF');
        Schema::dropIfExists('Timeslots');
        DB::statement('PRAGMA foreign_keys=ON');
    }
};
