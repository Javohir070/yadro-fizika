<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laboratory_teams', function (Blueprint $table) {
            $table->unsignedTinyInteger('type')->default(0)->after('laboratory_id');
        });
    }

    public function down(): void
    {
        Schema::table('laboratory_teams', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
