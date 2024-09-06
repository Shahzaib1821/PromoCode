<?php

use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [BackendController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [BackendController::class, 'dashboard'])->name('dashboard');

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
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
