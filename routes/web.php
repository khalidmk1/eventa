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




Route::middleware(['auth','organizare','admin' , 'verified'])->name('dashboard.')->prefix('dashboard')->group(function (){
    Route::get('/home', [DashboardController::class, 'home'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('table/participated', [DashboardController::class, 'checked_paticipated'])->name('table.participated');
});


Route::middleware(['auth','organizare' , 'verified'])->name('dashboard.event.')->prefix('event')->group(function (){
    Route::get('/create', [DashboardController::class, 'create'])->name('create');
    Route::post('/store', [DashboardController::class, 'store'])->name('store');
    Route::get('/show', [DashboardController::class, 'show'])->name('show');
    Route::get('/detail/{slug}', [DashboardController::class, 'detail'])->name('detail');
});

Route::name('home.')->prefix('/')->group(function (){
    Route::get('/', [LandingPageController::class, 'home'])->name('show');
    Route::get('events',[LandingPageController::class, 'show'])->name('event');
    Route::get('event/{slug}',[LandingPageController::class, 'detail'])->name('detail');
    //this count for event favoris
    Route::get('event/favoris/count', [LandingPageController::class, 'favoris_count'])->name('folow.count');
    //this for profile of landing page 
    Route::get('profile/{slug}', [LandingPageController::class, 'edit'])->name('profile');
    //this controller for folow event
    Route::post('folow/{slug}', [LandingPageController::class, 'event_folow'])->name('folow');
    //this controller for folow users 
    Route::post('folow/user/{slug}', [LandingPageController::class, 'user_folow'])->name('folow.user');

});

Route::middleware(['auth' , 'verified'])->name('home.')->prefix('/home')->group(function (){
    Route::get('/', [LandingPageController::class, 'home'])->name('index');
});

Route::middleware(['visiter' , 'auth' , 'verified'])->name('home.')->prefix('/')->group(function (){
    
    Route::put('update/{id}', [LandingPageController::class, 'update'])->name('update');
    Route::get('favoris', [LandingPageController::class, 'Favoris_list'])->name('favoris');
  
    //this is the controller of checked favoris and make confirme favoris table to false 
    Route::post('checked/{slug}', [LandingPageController::class, 'folow_checked'])->name('folow.checked');
    // this controller just unchecked the favori list 
    Route::post('unchecked/{slug}', [LandingPageController::class, 'unchecked_favoris'])->name('folow.unchecked');
    //this count for event favoris
    Route::get('favoris/count', [LandingPageController::class, 'favoris_count'])->name('folow.count');

    
  

});




Route::middleware('auth')->group(function () {
   /*  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); */
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
      //this count for event favoris
    Route::get('profile/favoris/count', [LandingPageController::class, 'favoris_count'])->name('folow.count');
    /* Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */
    Route::get('/email/verify', [ProfileController::class, 'verifyemail'])->name('verification.notice');
   
});

require __DIR__.'/auth.php';
