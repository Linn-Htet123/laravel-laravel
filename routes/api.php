<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ItemApiController;
use App\Http\Middleware\CheckApiToken;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\ApiAuthenticated;
use App\Http\Middleware\SetAcceptHeader;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
// Route::apiResource('book',BookController::class);
Route::prefix('v1')->group(function(){
    Route::apiResource('item',ItemApiController::class)->middleware(ApiAuthenticated::class);

//auth route
    Route::controller(AuthController::class)->name('api.auth.')->group(function(){
        Route::post('register',"register")->name('register');
        Route::post('login',"login")->name('login');
        Route::post('logout','logout')->name('logout')->middleware(ApiAuthenticated::class);
    });
});





