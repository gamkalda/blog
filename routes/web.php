<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Admin\Main\IndexController as Admin_Main_Indexcontroller;
use App\Http\Controllers\Admin\Category\IndexController as CategoryIndexController;
use App\Http\Controllers\Admin\Category\CreateController as CategoryCreateController;
use App\Http\Controllers\Admin\Category\StoreController as CategoryStoreController;


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

Route::group(['namespace' => 'Main'], function() {
    Route::get('/', [Indexcontroller::class, '__invoke']);
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::group(['namespace' => 'Main'], function() {
        Route::get('/', [Admin_Main_Indexcontroller::class, '__invoke']);
    });
    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function() {
        Route::get('/', [CategoryIndexController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CategoryCreateController::class, '__invoke'])->name('admin.category.create');
        Route::post('/store', [CategoryStoreController::class, '__invoke'])->name('admin.category.store');
    });

});

Auth::routes();



