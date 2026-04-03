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
        Schema::create('leaderships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->string('full_name_uz');
            $table->string('full_name_ru');
            $table->string('full_name_en');
            $table->string('position_uz', 1000);
            $table->string('position_ru', 1000);
            $table->string('position_en', 1000);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('photo');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaderships');
    }
};
