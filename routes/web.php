<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

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




Route::name('dashboard.')->prefix('dashboard')->group(function (){
    Route::get('/home', [DashboardController::class, 'home'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
})->middleware(['auth','organizare','admin']);


Route::name('dashboard.event.')->prefix('event')->group(function (){
    Route::get('/create', [DashboardController::class, 'create'])->name('create');
    Route::post('/store', [DashboardController::class, 'store'])->name('store');
    Route::get('/show', [DashboardController::class, 'show'])->name('show');
    Route::get('/detail/{slug}', [DashboardController::class, 'detail'])->name('detail');
})->middleware(['auth','organizer']);

Route::name('home.')->prefix('/')->group(function (){
    Route::get('/', [LandingPageController::class, 'home'])->name('show');
    Route::get('events',[LandingPageController::class, 'show'])->name('event');
    Route::get('event/{slug}',[LandingPageController::class, 'detail'])->name('detail');
    Route::get('profile/{slug}', [LandingPageController::class, 'edit'])->name('profile');
    Route::put('update/{id}', [LandingPageController::class, 'update'])->name('update');
    Route::post('folow/{slug}', [LandingPageController::class, 'event_folow'])->name('folow');
    Route::get('trake/folow', [LandingPageController::class, 'folow_trake'])->name('trake');
})->middleware(['visiter']);




Route::middleware('auth')->group(function () {
   /*  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); */
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    /* Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */
});

require __DIR__.'/auth.php';
