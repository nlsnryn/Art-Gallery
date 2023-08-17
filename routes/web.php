<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\QueryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route for users authenticated
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::middleware(['check.userlevel:super admin'])->group(function () {
        Route::resource('/admin', AdminController::class);
    });

    Route::middleware(['check.userlevel:super admin,admin'])->group(function () {
        Route::resource('/artist', ArtistController::class);
    });
    
    Route::resource('/artwork', ArtController::class);

    Route::prefix('/artwork/{artwork}')->group(function () {
        Route::prefix('queries')->group(function () {
            Route::get('/history', [QueryController::class, 'history'])->name('query.history');
            Route::patch('/{query}', [QueryController::class, 'update'])->name('query.update');
            Route::get('/{query}', [QueryController::class, 'show'])->name('query.show');
        });
    });
});

// Route for guest
Route::middleware('guest')->group(function () {
    Route::get('/', [GuestController::class, 'index'])->name('dashboard');
    Route::get('/guest/artwork/{artwork}', [GuestController::class, 'show_art'])->name('guest.art.show');
    Route::get('/guest/artist/{artist}', [GuestController::class, 'show_artist'])->name('guest.artist.show');

    Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
    Route::post('login', [AuthenticationController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::prefix('/artwork/{artwork}')->group(function () {
        Route::prefix('queries')->group(function () {
            Route::get('/', [QueryController::class, 'success'])->name('query.success');
            Route::post('/', [QueryController::class, 'store'])->name('query.store');

        });
    });
});









