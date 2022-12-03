<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\UserController;
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



Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {

    Route::post('register', [UserController::class, 'register'])->name('register');
    Route::post('login', [UserController::class, 'login'])->name('login');

    Route::group(
        ['middleware' => ['auth:api', 'user.auth']],
        function () {
            Route::post('logout', [UserController::class, 'logout'])->name('logout');
            Route::get('profile', [UserController::class, 'profile'])->name('profile');
        }
    );
});



Route::group(['middleware' => ['auth:api', 'user.auth']], function () {

    Route::group(['prefix' => 'categories', 'as' => 'category.api.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'subcategories', 'as' => 'subcategory.api.'], function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('index');
        Route::get('/{subcategory}', [SubCategoryController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'items', 'as' => 'item.api.'], function () {
        Route::get('/', [ItemController::class, 'index'])->name('index');
        Route::get('/{item}', [ItemController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::post('/', [OrderController::class, 'store'])->name('store');
    });
});
