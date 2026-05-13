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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('title_uz', 1000);
            $table->string('title_ru', 1000);
            $table->string('title_en', 1000);
            $table->longText('description_uz');
            $table->longText('description_ru');
            $table->longText('description_en');
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('location_uz', 1000);
            $table->string('location_ru', 1000);
            $table->string('location_en', 1000);
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
        Schema::dropIfExists('conferences');
    }
};
