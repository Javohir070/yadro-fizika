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
        Schema::create('laboratory_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_id')->constrained('laboratories')->onDelete('cascade');
            $table->string('full_name_uz', 600);
            $table->string('full_name_ru', 600);
            $table->string('full_name_en', 600);
            $table->string('position_uz', 600);
            $table->string('position_ru', 600);
            $table->string('position_en', 600);
            $table->longText('degree_uz')->nullable();
            $table->longText('degree_ru')->nullable();
            $table->longText('degree_en')->nullable();
            $table->string('image');
            $table->string('google_scholar')->nullable()->url();
            $table->string('web_of_science')->nullable()->url();
            $table->string('scopus')->nullable()->url();
            $table->string('researchgate')->nullable()->url();
            $table->string('orcid')->nullable()->url();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_teams');
    }
};
