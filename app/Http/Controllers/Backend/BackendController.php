<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class BackendController extends Controller
{
    public function dashboard()
    {
        return view('backend.layouts.app');
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
