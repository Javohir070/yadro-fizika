<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CouncilMemberController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScientificCouncilController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\VideoGallerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DoctoralController;
use App\Http\Controllers\HomeController;

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
        Route::resource('abouts', AboutController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('leaderships', LeadershipController::class);
        Route::resource('news', NewsController::class);
        Route::resource('images', ImageController::class);
        Route::resource('partners', PartnerController::class);
        Route::resource('galleries', GalleryController::class);
        Route::resource('structures', StructureController::class);
        Route::resource('doctorals', DoctoralController::class);
        Route::resource('scientific-councils', ScientificCouncilController::class);
        Route::resource('council-members', CouncilMemberController::class);
        Route::resource('video-gallers', VideoGallerController::class);
    });
});

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home.index');

require __DIR__.'/auth.php';
