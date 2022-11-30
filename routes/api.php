<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['prefix' => 'auth','as'=>'auth.'], function () {

    Route::post('register', [UserController::class, 'register'])->name('register');
    Route::post('login', [UserController::class, 'login'])->name('login');

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
    });
});



Route::group(['middleware' => 'auth:api'], function () {

    Route::group(['prefix' => 'pack','as'=>'pack.'], function () {
        Route::get('/', [PackController::class, 'index'])->name('index');
        Route::get('/{pack}', [PackController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'promo-code','as'=>'promo_code.'], function () {
        Route::post('/check', [PromoCodeController::class, 'check'])->name('check');
    });

    Route::group(['prefix' => 'order','as'=>'order.'], function () {
        Route::post('/', [OrderController::class, 'store'])->name('store');
    });

});
