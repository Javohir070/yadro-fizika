<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conference_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conference_id')->constrained()->cascadeOnDelete();
            $table->string('file');
            $table->string('original_name')->nullable();
            $table->timestamps();
        });

        if (Schema::hasColumn('conferences', 'file')) {
            $conferences = DB::table('conferences')
                ->whereNotNull('file')
                ->where('file', '!=', '')
                ->get(['id', 'file']);

            foreach ($conferences as $conference) {
                DB::table('conference_files')->insert([
                    'conference_id' => $conference->id,
                    'file' => $conference->file,
                    'original_name' => basename($conference->file),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            Schema::table('conferences', function (Blueprint $table) {
                $table->dropColumn('file');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('conferences', 'file')) {
            Schema::table('conferences', function (Blueprint $table) {
                $table->string('file')->nullable();
            });
        }

        if (Schema::hasTable('conference_files')) {
            $firstFiles = DB::table('conference_files')
                ->select('conference_id', 'file')
                ->orderBy('id')
                ->get()
                ->unique('conference_id');

            foreach ($firstFiles as $file) {
                DB::table('conferences')
                    ->where('id', $file->conference_id)
                    ->update(['file' => $file->file]);
            }
        }

        Schema::dropIfExists('conference_files');
    }
};
