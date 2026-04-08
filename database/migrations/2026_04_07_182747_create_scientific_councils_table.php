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
        Schema::create('scientific_councils', function (Blueprint $table) {
            $table->id();
            $table->string('title_uz', 1000);
            $table->string('title_ru', 1000);
            $table->string('title_en', 1000);
            $table->text('council_duties_uz');
            $table->text('council_duties_ru');
            $table->text('council_duties_en');
            $table->string('image');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scientific_councils');
    }
};
