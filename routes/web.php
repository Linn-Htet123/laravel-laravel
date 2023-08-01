<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsAuthenticated;
use App\Http\Middleware\IsNotAuthenticated;
use App\Http\Middleware\IsVerified;
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

Route::get('/',[PageController::class,'home'])->name('page.home');
//Route::prefix('inventory')->controller(ItemController::class)->name('inventory.')->group(function (){
//    Route::get('/','index')->name('index');
//    Route::post('/','store')->name('store');
//    Route::get('/create','create')->name('create');
//    Route::get('/{id}','show')->name('show');
//    Route::get('/{id}/edit','edit')->name('edit');
//    Route::put('/{id}','update')->name('update');
//    Route::delete('/{id}','destroy')->name('destroy');
//});
Route::middleware(IsAuthenticated::class)->group(function(){
    Route::resource('inventory', ItemController::class);
    Route::resource("category",CategoryController::class);
    Route::controller(HomeController::class)->name('dashboard.')->prefix('dashboard')->group(function (){
        Route::get("home","home")->name('home');
    });

});


Route::controller(AuthController::class)->name('auth.')->group(function (){
    Route::middleware(IsNotAuthenticated::class)->group(function(){
        Route::get('register',"register")->name('register');
        Route::post('register',"store")->name('store');
        Route::get('login',"login")->name('login');
        Route::post('login',"check")->name('check');

        Route::post('check-email',"checkEmail")->name('checkEmail');
        Route::get('forgot',"forgot")->name('forgot');
        Route::get('new-password',"newPassword")->name('newPassword');
        Route::post('reset-password',"resetPassword")->name('resetPassword');

    });
    Route::middleware(IsAuthenticated::class)->group(function(){
        Route::post('logout',"logout")->name('logout');
        Route::middleware(IsVerified::class)->group(function(){
            Route::get('password-change',"passwordChange")->name('passwordChange');
            Route::post('password-change',"passwordChanging")->name('passwordChanging');
        });
        Route::get('verify',"verify")->name('verify');
        Route::post('verifying',"verifying")->name('verifying');
    });


});

