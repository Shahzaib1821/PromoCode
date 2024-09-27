<?php

use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogsController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DealController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StoreController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [BackendController::class, 'dashboard'])->name('dashboard');

        Route::get('/admin/settings', [BackendController::class, 'settings'])->name('admin.settings');
        Route::post('/admin/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
        Route::post('/admin/settings/reset', [SettingsController::class, 'reset'])->name('admin.settings.reset');

        Route::get('deals/activity-log', [BackendController::class, 'getDealsActivityLog'])->name('deals.activity.log');
        Route::get('coupons/activity-log', [BackendController::class, 'getCouponsActivityLog'])->name('coupons.activity.log');
        Route::get('/stores/activity-log', [BackendController::class, 'getStoresActivityLog'])->name('stores.activity.log');

        Route::resource('adminUser', AdminUserController::class);
        Route::resource('users', UsersController::class);

        Route::resource('categories', CategoryController::class);
        Route::get('categories/{slug}', 'CategoryController@show')->name('categories.show');
        Route::resource('subcategories', SubCategoryController::class);

        Route::resource('store', StoreController::class);

        Route::resource('coupons', CouponController::class);
        Route::post('/admin/coupons/reorder', [CouponController::class, 'reorder'])->name('coupons.reorder');

        Route::resource('deals', DealController::class);
        Route::post('/admin/deals/reorder', [DealController::class, 'reorder'])->name('deals.reorder');

        Route::resource('blogs', BlogsController::class);

        Route::resource('banners', BannerController::class);

        Route::resource('sliders', SliderController::class);

        // blogcategories
        Route::resource('blogcategories', BlogCategoryController::class);
        Route::post('/blogcategories/reorder', [BlogCategoryController::class, 'updateReorder'])->name('blogcategories.reorder');
    });
});
