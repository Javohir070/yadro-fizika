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
 * Bitta yozuv: `news/{id}`, `ads/{id}`, `conferences/{id}` — `InputRequest` (lang, status).
 */

use App\Http\Controllers\Api\AboutApiController;
use App\Http\Controllers\Api\AdApiController;
use App\Http\Controllers\Api\BannerApiController;
use App\Http\Controllers\Api\CharterApiController;
use App\Http\Controllers\Api\ConferenceApiController;
use App\Http\Controllers\Api\CouncilMemberApiController;
use App\Http\Controllers\Api\DepartmentApiController;
use App\Http\Controllers\Api\DoctoralApiController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\InstituteDirectorController;
use App\Http\Controllers\Api\InstituteHistoryApiController;
use App\Http\Controllers\Api\InstituteStructureApiController;
use App\Http\Controllers\Api\InternationalCollaborationApiController;
use App\Http\Controllers\Api\LaboratoryApiController;
use App\Http\Controllers\Api\LaboratoryTeamApiController;
use App\Http\Controllers\Api\LeadershipApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PartnerApiController;
use App\Http\Controllers\Api\ScientificActivityApiController;
use App\Http\Controllers\Api\ScientificCouncilApiController;
use App\Http\Controllers\Api\StatApiController;
use App\Http\Controllers\Api\StructureApiController;
use App\Http\Controllers\Api\VideoGalleryApiController;
use App\Http\Controllers\Api\WorkActivityApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('about', [AboutApiController::class, 'index']);

Route::get('institute-director', [InstituteDirectorController::class, 'index']);

Route::get('institute-history', [InstituteHistoryApiController::class, 'index']);

Route::get('charter', [CharterApiController::class, 'index']);

Route::get('institute-structure', [InstituteStructureApiController::class, 'index']);

Route::get('scientific-council', [ScientificCouncilApiController::class, 'index']);

Route::get('structure', [StructureApiController::class, 'index']);
Route::get('structures', [StructureApiController::class, 'list']);

Route::get('news', [NewsApiController::class, 'index']);
Route::get('news/{id}', [NewsApiController::class, 'show']);
Route::get('banners', [BannerApiController::class, 'index']);
Route::get('ads', [AdApiController::class, 'index']);
Route::get('ads/{id}', [AdApiController::class, 'show']);
Route::get('conferences', [ConferenceApiController::class, 'index']);
Route::get('conferences/{id}', [ConferenceApiController::class, 'show']);
Route::get('galleries', [GalleryApiController::class, 'index']);
Route::get('video-gallery', [VideoGalleryApiController::class, 'index']);
Route::get('partners', [PartnerApiController::class, 'index']);
Route::get('leadership', [LeadershipApiController::class, 'index']);
Route::get('departments', [DepartmentApiController::class, 'index']);
Route::get('laboratories', [LaboratoryApiController::class, 'index']);
Route::get('laboratories/{id}', [LaboratoryApiController::class, 'show']);
Route::get('laboratory-teams/list', [LaboratoryTeamApiController::class, 'list']);
Route::get('laboratory-teams', [LaboratoryTeamApiController::class, 'index']);
Route::get('laboratory-teams/{id}', [LaboratoryTeamApiController::class, 'show']);
Route::get('work-activities/list', [WorkActivityApiController::class, 'list']);
Route::get('work-activities', [WorkActivityApiController::class, 'index']);
Route::get('work-activities/{id}', [WorkActivityApiController::class, 'show']);
Route::get('scientific-activities', [ScientificActivityApiController::class, 'index']);
Route::get('scientific-activities/{id}', [ScientificActivityApiController::class, 'show']);
Route::get('international-collaborations', [InternationalCollaborationApiController::class, 'index']);
Route::get('doctorals', [DoctoralApiController::class, 'index']);
Route::get('council-members', [CouncilMemberApiController::class, 'index']);
Route::get('stats', [StatApiController::class, 'index']);
