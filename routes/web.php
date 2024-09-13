<?php

use App\Http\Controllers\Frontend\PagesController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/categories', [PagesController::class, 'category'])->name('categories');
Route::get('/stores', [PagesController::class, 'store'])->name('stores');
Route::get('/store/{slug}', [PagesController::class, 'storeDetail'])->name('stores-details');
// Route::get('/coupons', [PagesController::class, 'index'])->name('coupons');
// Route::get('/blogs', [PagesController::class, 'index'])->name('blogs');
// Route::get('/about', [PagesController::class, 'about'])->name('about');
// Route::get('/saving-tips', [PagesController::class, 'savingTips'])->name('saving-tips');
// Route::get('/write-for-us', [PagesController::class, 'writeForUs'])->name('write-for-us');
// Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('privacy-policy');
// Route::get('/terms-and-conditions', [PagesController::class, 'termsConditions'])->name('terms-conditions');
// Route::get('/faq', [PagesController::class, 'faq'])->name('faq');
// Route::get('/shipping', [PagesController::class, 'shipping'])->name('shipping');
// Route::get('/returns', [PagesController::class, 'returns'])->name('returns');
// Route::get('/order-status', [PagesController::class, 'orderStatus'])->name('order-status');
// Route::get('/payment-options', [PagesController::class, 'paymentOptions'])->name('payment-options');
// Route::get('/download', [PagesController::class, 'download'])->name('download');
// Route::get('/changelog', [PagesController::class, 'changelog'])->name('changelog');
// Route::get('/github', [PagesController::class, 'github'])->name('github');
// Route::get('/all-versions', [PagesController::class, 'allVersions'])->name('all-versions');

require __DIR__.'/auth.php';
require __DIR__.'/backend.php';
