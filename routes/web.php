<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CharterController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\CouncilMemberController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctoralController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InstituteDirectorController;
use App\Http\Controllers\InstituteHistoryController;
use App\Http\Controllers\InstituteStructureController;
use App\Http\Controllers\InternationalCollaborationController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\LaboratoryTeamController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScientificActivityController;
use App\Http\Controllers\ScientificCouncilController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\UserController;
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
        $menuPermissions = config('menu_permissions.resources');

        Route::resource('banners', BannerController::class)
            ->middleware('permission:'.$menuPermissions['banners']);
        Route::resource('ads', AdController::class)
            ->middleware('permission:'.$menuPermissions['ads']);
        Route::resource('conferences', ConferenceController::class)
            ->middleware('permission:'.$menuPermissions['conferences']);
        Route::resource('abouts', AboutController::class)
            ->middleware('permission:'.$menuPermissions['abouts']);
        Route::resource('institute-histories', InstituteHistoryController::class)
            ->middleware('permission:'.$menuPermissions['institute-histories']);
        Route::resource('charters', CharterController::class)
            ->middleware('permission:'.$menuPermissions['charters']);

        $laboratoryPermission = $menuPermissions['laboratories'];
        Route::resource('laboratories', LaboratoryController::class)
            ->middleware('permission:'.$laboratoryPermission);

        Route::prefix('laboratories/{laboratory}')->name('laboratories.')
            ->middleware('permission:'.$laboratoryPermission)
            ->group(function () {
                Route::resource('teams', LaboratoryTeamController::class)->except(['index']);
                Route::resource('teams.work-activities', WorkActivityController::class)->except(['index']);
                Route::post('scientific-activities', [ScientificActivityController::class, 'store'])->name('scientific-activities.store');
                Route::put('scientific-activities/{scientific_activity}', [ScientificActivityController::class, 'update'])->name('scientific-activities.update');
                Route::post('international-collaborations', [InternationalCollaborationController::class, 'store'])->name('international-collaborations.store');
                Route::put('international-collaborations/{international_collaboration}', [InternationalCollaborationController::class, 'update'])->name('international-collaborations.update');
            });

        Route::resource('institute-directors', InstituteDirectorController::class)
            ->middleware('permission:'.$menuPermissions['institute-directors']);
        Route::resource('institute-structures', InstituteStructureController::class)
            ->middleware('permission:'.$menuPermissions['institute-structures']);
        Route::resource('departments', DepartmentController::class)
            ->middleware('permission:'.$menuPermissions['departments']);
        Route::resource('leaderships', LeadershipController::class)
            ->middleware('permission:'.$menuPermissions['leaderships']);
        Route::resource('news', NewsController::class)
            ->middleware('permission:'.$menuPermissions['news']);
        Route::resource('images', ImageController::class)
            ->middleware('permission:'.$menuPermissions['images']);
        Route::resource('partners', PartnerController::class)
            ->middleware('permission:'.$menuPermissions['partners']);

        $galleryPermission = $menuPermissions['galleries'];
        Route::post('galleries/{gallery}/images', [GalleryController::class, 'storeImages'])
            ->middleware('permission:'.$galleryPermission)
            ->name('galleries.images.store');
        Route::resource('galleries', GalleryController::class)
            ->middleware('permission:'.$galleryPermission);

        Route::resource('structures', StructureController::class)
            ->middleware('permission:'.$menuPermissions['structures']);
        Route::resource('doctorals', DoctoralController::class)
            ->middleware('permission:'.$menuPermissions['doctorals']);
        Route::resource('publications', PublicationController::class)
            ->middleware('permission:'.$menuPermissions['publications']);
        Route::resource('events', EventController::class)
            ->middleware('permission:'.$menuPermissions['events']);
        Route::resource('scientific-councils', ScientificCouncilController::class)
            ->middleware('permission:'.$menuPermissions['scientific-councils']);
        Route::resource('council-members', CouncilMemberController::class)
            ->middleware('permission:'.$menuPermissions['council-members']);
        Route::resource('video-gallers', VideoGallerController::class)
            ->middleware('permission:'.$menuPermissions['video-gallers']);
        Route::resource('stats', StatController::class)
            ->middleware('permission:'.$menuPermissions['stats']);
        Route::resource('users', UserController::class)
            ->middleware('permission:'.$menuPermissions['users']);
        Route::resource('roles', RoleController::class)
            ->middleware('permission:'.$menuPermissions['roles']);
        Route::resource('permissions', PermissionController::class)
            ->middleware('permission:'.$menuPermissions['permissions']);
    });
});

Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth', 'permission:'.config('menu_permissions.home')])
    ->name('home.index');

require __DIR__.'/auth.php';
