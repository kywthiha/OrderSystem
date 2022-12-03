<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth', 'admin.auth']], function () {
    Route::resource("categories", CategoryController::class)->middleware('can:manage_categories');
    Route::resource("subcategories", SubCategoryController::class)->middleware('can:manage_subcategories');
    Route::resource("items", ItemController::class)->middleware('can:manage_items');
    Route::resource('users', UserController::class)->middleware('can:manage_users');
    Route::resource("admins", AdminController::class)->middleware('can:manage_admins');
    Route::resource("roles", RoleController::class)->middleware('can:manage_roles');
});
