<?php

use App\Models\Image;
use App\Models\News;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->nullableMorphs('imageable');
        });

        Image::query()->each(function (Image $image): void {
            $image->update([
                'imageable_type' => News::class,
                'imageable_id' => $image->news_id,
            ]);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['news_id']);
            $table->dropColumn('news_id');
        });
    }

    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->foreignId('news_id')->nullable()->after('id')->constrained('news')->onDelete('cascade');
        });

        Image::query()
            ->where('imageable_type', News::class)
            ->each(function (Image $image): void {
                $image->update(['news_id' => $image->imageable_id]);
            });

        Schema::table('images', function (Blueprint $table) {
            $table->dropMorphs('imageable');
        });
    }
};
