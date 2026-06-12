<?php

use App\Enums\LaboratoryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laboratories', function (Blueprint $table) {
            $table
                ->enum('type', array_column(LaboratoryType::cases(), 'value'))
                ->default(LaboratoryType::Laboratory->value)
                ->after('name_en')
                ->index();
        });
    }

    public function down(): void
    {
        Schema::table('laboratories', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
