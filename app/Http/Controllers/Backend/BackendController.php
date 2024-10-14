<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class BackendController extends Controller
{
    public function dashboard()
    {
        $user = User::all();
        $stores = Store::all();
        $coupons = Coupon::whereNotNull('coupon_code')->get();
        $deals = Coupon::whereNull('coupon_code')->get();
        $categories = Category::all();

        // Fetch top stores with creator and updater relationships
        $top_stores = Store::where('top_stores', true)
            ->with(['creator', 'updater']) // Eager load creator and updater relationships
            ->withCount([
                'coupons as coupons_count' => function ($query) {
                    $query->whereNotNull('coupon_code');  // Only count coupons
                },
                'coupons as deals_count' => function ($query) {
                    $query->whereNull('coupon_code');  // Only count deals
                }
            ])->get();

        return view('backend.layouts.plan', compact('user', 'stores', 'coupons', 'deals', 'categories', 'top_stores'));
    }

    public function activityLog()
    {
        $activities = Activity::with('causer')->latest()->paginate(20);
        return view('backend.setting.activity_log', compact('activities'));
    }

    public function getDealsActivityLog()
    {
        $activities = Activity::where('properties->type', 'deal')->paginate(10);
        return view('backend.setting.deals.activity_log', compact('activities'));
    }

    public function getCouponsActivityLog()
    {
        $activities = Activity::where('properties->type', 'coupon')->paginate(10);
        return view('backend.setting.coupons.activity_log', compact('activities'));
    }

    public function getStoresActivityLog()
    {
        $activities = Activity::where('properties->type', 'store')->paginate(10);
        return view('backend.setting.stores.activity_log', compact('activities'));
    }

    public function settings()
    {
        return app(SettingsController::class)->index();
    }
}
