<?php

/**
 * Jamoat API marshrutlari.
 *
 * Umumiy query parametrlar (ko‘pchilik endpointlar):
 * - status: 1 | 0 — aktiv / nofaol yozuvlar.
 * - lang: uz | ru | en — matn maydonlari qaysi tilda qaytarilishini belgilaydi.
 * - page, per_page (faqat sahifalangan ro‘yxatlar): standart 1 va 15, per_page maks. 50.
 *
 * Bir nechta resursda `index` bitta yozuv (first), `.../list` yoki ko‘plik nomi sahifalangan ro‘yxat.
 */

use App\Http\Controllers\Api\AboutApiController;
use App\Http\Controllers\Api\BannerApiController;
use App\Http\Controllers\Api\CouncilMemberApiController;
use App\Http\Controllers\Api\DepartmentApiController;
use App\Http\Controllers\Api\DoctoralApiController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\InstituteDirectorController;
use App\Http\Controllers\Api\InstituteHistoryApiController;
use App\Http\Controllers\Api\InstituteStructureApiController;
use App\Http\Controllers\Api\LeadershipApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PartnerApiController;
use App\Http\Controllers\Api\ScientificCouncilApiController;
use App\Http\Controllers\Api\StructureApiController;
use App\Http\Controllers\Api\VideoGalleryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('about', [AboutApiController::class, 'index']);
Route::get('abouts', [AboutApiController::class, 'list']);

Route::get('institute-director', [InstituteDirectorController::class, 'index']);
Route::get('institute-directors', [InstituteDirectorController::class, 'list']);

Route::get('institute-history', [InstituteHistoryApiController::class, 'index']);
Route::get('institute-histories', [InstituteHistoryApiController::class, 'list']);

Route::get('institute-structure', [InstituteStructureApiController::class, 'index']);
Route::get('institute-structures', [InstituteStructureApiController::class, 'list']);

Route::get('scientific-council', [ScientificCouncilApiController::class, 'index']);
Route::get('scientific-councils', [ScientificCouncilApiController::class, 'list']);

Route::get('structure', [StructureApiController::class, 'index']);
Route::get('structures', [StructureApiController::class, 'list']);

Route::get('news', [NewsApiController::class, 'index']);
Route::get('banners', [BannerApiController::class, 'index']);
Route::get('galleries', [GalleryApiController::class, 'index']);
Route::get('video-gallery', [VideoGalleryApiController::class, 'index']);
Route::get('partners', [PartnerApiController::class, 'index']);
Route::get('leadership', [LeadershipApiController::class, 'index']);
Route::get('departments', [DepartmentApiController::class, 'index']);
Route::get('doctorals', [DoctoralApiController::class, 'index']);
Route::get('council-members', [CouncilMemberApiController::class, 'index']);
