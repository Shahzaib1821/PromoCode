<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::with('store')->get();
        return view('backend.pages.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $stores = Store::all();
        return view('backend.pages.coupons.create', compact('stores'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'coupon_code' => 'required|string|max:255|unique:coupons',
            'store_id' => 'required|exists:stores,id',
            'discounted_price' => 'required|string|max:255',
            'expiry_date' => 'required|date',
            'created_date' => 'required|date',
            'affiliated_link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'deal_exclusive' => 'boolean',
            'verify' => 'boolean',
        ]);

        $validatedData['deal_exclusive'] = $request->has('deal_exclusive');
        $validatedData['verify'] = $request->has('verify');

        Coupon::create($validatedData);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function show(Coupon $coupon)
    {
        return view('backend.pages.coupons.show', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        $stores = Store::all();
        return view('backend.pages.coupons.edit', compact('coupon', 'stores'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'coupon_code' => 'required|string|max:255|unique:coupons,coupon_code,' . $coupon->id,
            'store_id' => 'required|exists:stores,id',
            'discounted_price' => 'required|string|max:255',
            'expiry_date' => 'required|date',
            'created_date' => 'required|date',
            'affiliated_link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
            'description' => 'required|string',
            'deal_exclusive' => 'nullable|boolean',  // Now optional
            'verify' => 'nullable|boolean',          // Now optional
        ]);

        // Handle the checkbox values
        $validatedData['deal_exclusive'] = $request->has('deal_exclusive') ? 1 : 0;
        $validatedData['verify'] = $request->has('verify') ? 1 : 0;

        $coupon->update($validatedData);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }


    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
