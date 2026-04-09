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
        Schema::create('council_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scientific_council_id')->constrained('scientific_councils')->onDelete('cascade');
            $table->string('full_name_uz');
            $table->string('full_name_ru');
            $table->string('full_name_en');
            $table->string('position_uz', 1000);
            $table->string('position_ru', 1000);
            $table->string('position_en', 1000);
            $table->string('degree_uz');
            $table->string('degree_ru');
            $table->string('degree_en');
            $table->string('photo');
            $table->integer('order');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('council_members');
    }
};
