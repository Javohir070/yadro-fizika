<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scientific_activities', function (Blueprint $table) {
            $table->dropForeign(['laboratory_id']);
            $table->foreign('laboratory_id')
                ->references('id')
                ->on('laboratories')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('scientific_activities', function (Blueprint $table) {
            $table->dropForeign(['laboratory_id']);
            $table->foreign('laboratory_id')
                ->references('id')
                ->on('laboratory_teams')
                ->cascadeOnDelete();
        });
    }
};
