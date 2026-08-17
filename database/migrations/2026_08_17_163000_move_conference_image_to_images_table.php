<?php

use App\Models\Conference;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('conferences', 'image')) {
            return;
        }

        $conferences = DB::table('conferences')
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->get(['id', 'image']);

        foreach ($conferences as $conference) {
            DB::table('images')->insert([
                'imageable_type' => Conference::class,
                'imageable_id' => $conference->id,
                'image' => $conference->image,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('conferences', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('conferences', 'image')) {
            Schema::table('conferences', function (Blueprint $table) {
                $table->string('image')->nullable();
            });
        }

        $firstImages = DB::table('images')
            ->where('imageable_type', Conference::class)
            ->select('imageable_id', 'image')
            ->orderBy('id')
            ->get()
            ->unique('imageable_id');

        foreach ($firstImages as $image) {
            DB::table('conferences')
                ->where('id', $image->imageable_id)
                ->update(['image' => $image->image]);
        }

        DB::table('images')
            ->where('imageable_type', Conference::class)
            ->delete();
    }
};
