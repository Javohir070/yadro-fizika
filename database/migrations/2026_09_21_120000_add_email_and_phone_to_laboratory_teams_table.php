<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laboratory_teams', function (Blueprint $table) {
            $table->string('email')->nullable()->after('image');
            $table->string('phone', 50)->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('laboratory_teams', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone']);
        });
    }
};
