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
        Schema::create('doctorals', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz', 1000);
            $table->string('name_ru', 1000);
            $table->string('name_en', 1000);
            $table->string('code');
            $table->string('file')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctorals');
    }
};
