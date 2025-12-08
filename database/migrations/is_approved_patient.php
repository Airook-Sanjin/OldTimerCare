<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('Patient', function (Blueprint $table) {//default(false) before i changed it
            $table->boolean('is_approved')->default(true)->after('CaregiverID');
        });
    }

    public function down(): void
    {
        Schema::table('Patient', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });
    }
};
