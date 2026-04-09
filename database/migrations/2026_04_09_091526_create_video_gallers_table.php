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
        Schema::create('video_gallers', function (Blueprint $table) {
            $table->id();
            $table->text('title_uz', 1000);
            $table->text('title_ru', 1000);
            $table->text('title_en', 1000);
            $table->text('description_uz', 1000)->nullable();
            $table->text('description_ru', 1000)->nullable();
            $table->text('description_en', 1000)->nullable();
            $table->string('url');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_gallers');
    }
};
