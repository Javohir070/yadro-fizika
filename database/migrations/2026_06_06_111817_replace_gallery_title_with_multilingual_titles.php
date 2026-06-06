<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('title_uz')->nullable()->after('id');
            $table->string('title_ru')->nullable()->after('title_uz');
            $table->string('title_en')->nullable()->after('title_ru');
        });

        if (Schema::hasColumn('galleries', 'title')) {
            DB::table('galleries')->whereNotNull('title')->update([
                'title_uz' => DB::raw('title'),
                'title_ru' => DB::raw('title'),
                'title_en' => DB::raw('title'),
            ]);

            Schema::table('galleries', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
    }

    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
        });

        DB::table('galleries')->update([
            'title' => DB::raw('title_uz'),
        ]);

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['title_uz', 'title_ru', 'title_en']);
        });
    }
};
