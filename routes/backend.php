<?php

use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BlogsController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\Backend\StoreController;
use App\Http\Controllers\Backend\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [BackendController::class, 'dashboard'])->name('dashboard');

        Route::get('/adminUser', [AdminUserController::class, 'index'])->name('adminUser.index');
        Route::get('adminUser/create', [AdminUserController::class, 'create'])->name('adminUser.create');
        Route::post('adminUser/store', [AdminUserController::class, 'store'])->name('adminUser.store');
        Route::get('/adminUser/{id}/edit', [AdminUserController::class, 'edit'])->name('adminUser.edit');
        Route::put('/adminUser/{id}', [AdminUserController::class, 'update'])->name('adminUser.update');
        Route::delete('/adminUser/{id}', [AdminUserController::class, 'destroy'])->name('adminUser.destroy');

        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('/users/{menu}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/users/{menu}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{menu}', [UsersController::class, 'destroy'])->name('users.destroy');

        Route::resource('categories', CategoryController::class);
        Route::get('categories/{slug}', 'CategoryController@show')->name('categories.show');

        Route::resource('store', StoreController::class);

        Route::resource('coupons', CouponController::class);

        Route::resource('blogs', BlogsController::class);
    });
});
