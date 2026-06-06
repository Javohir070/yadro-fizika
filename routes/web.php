<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CharterController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\CouncilMemberController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctoralController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InstituteDirectorController;
use App\Http\Controllers\InstituteHistoryController;
use App\Http\Controllers\InternationalCollaborationController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\LaboratoryTeamController;
use App\Http\Controllers\ScientificActivityController;
use App\Http\Controllers\InstituteStructureController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScientificCouncilController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\VideoGallerController;
use App\Http\Controllers\WorkActivityController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('banners', BannerController::class);
        Route::resource('ads', AdController::class);
        Route::resource('conferences', ConferenceController::class);
        Route::resource('abouts', AboutController::class);
        Route::resource('institute-histories', InstituteHistoryController::class);
        Route::resource('charters', CharterController::class);
        Route::resource('laboratories', LaboratoryController::class);

        Route::prefix('laboratories/{laboratory}')->name('laboratories.')->group(function () {
            Route::resource('teams', LaboratoryTeamController::class)->except(['index']);

            Route::resource('teams.work-activities', WorkActivityController::class)->except(['index']);
            Route::post('scientific-activities', [ScientificActivityController::class, 'store'])->name('scientific-activities.store');
            Route::put('scientific-activities/{scientific_activity}', [ScientificActivityController::class, 'update'])->name('scientific-activities.update');
            Route::post('international-collaborations', [InternationalCollaborationController::class, 'store'])->name('international-collaborations.store');
            Route::put('international-collaborations/{international_collaboration}', [InternationalCollaborationController::class, 'update'])->name('international-collaborations.update');
        });
        Route::resource('institute-directors', InstituteDirectorController::class);
        Route::resource('institute-structures', InstituteStructureController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('leaderships', LeadershipController::class);
        Route::resource('news', NewsController::class);
        Route::resource('images', ImageController::class);
        Route::resource('partners', PartnerController::class);
        Route::post('galleries/{gallery}/images', [GalleryController::class, 'storeImages'])->name('galleries.images.store');
        Route::resource('galleries', GalleryController::class);
        Route::resource('structures', StructureController::class);
        Route::resource('doctorals', DoctoralController::class);
        Route::resource('scientific-councils', ScientificCouncilController::class);
        Route::resource('council-members', CouncilMemberController::class);
        Route::resource('video-gallers', VideoGallerController::class);
        Route::resource('stats', StatController::class);
    });
});

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home.index');

require __DIR__.'/auth.php';
