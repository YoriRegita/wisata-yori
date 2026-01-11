<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// homepage + publik wisata
Route::get('/', [WisataController::class, 'index'])->name('home');
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{wisata}', [WisataController::class, 'show'])->name('wisata.show');


/*
|--------------------------------------------------------------------------
| Dashboard (Breeze)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile (Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/wisata', [WisataController::class, 'adminIndex'])
            ->name('wisata.index');

        Route::get('/wisata/tambah', [WisataController::class, 'create'])
            ->name('wisata.create');

        Route::post('/wisata', [WisataController::class, 'store'])
            ->name('wisata.store');

        Route::get('/wisata/{wisata}/edit', [WisataController::class, 'edit'])
            ->name('wisata.edit');

        Route::put('/wisata/{wisata}', [WisataController::class, 'update'])
            ->name('wisata.update');

        Route::delete('/wisata/{wisata}', [WisataController::class, 'destroy'])
            ->name('wisata.destroy');
    });

require __DIR__.'/auth.php';
