<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index(Request $request)
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
        $validatedData['created_by'] = Auth::id();
        $validatedData['updated_by'] = null;

        DB::transaction(function () use ($validatedData) {
            $lastSortOrder = Coupon::where('store_id', $validatedData['store_id'])->max('sort_order') ?? 0;
            $validatedData['sort_order'] = $lastSortOrder + 1;
            Coupon::create($validatedData);
        });

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
            'deal_exclusive' => 'nullable|boolean',
            'verify' => 'nullable|boolean',
            'sort_order' => 'required|integer|min:1',
        ]);

        $validatedData['deal_exclusive'] = $request->has('deal_exclusive') ? 1 : 0;
        $validatedData['verify'] = $request->has('verify') ? 1 : 0;
        $validatedData['updated_by'] = Auth::id();

        $oldSortOrder = $coupon->sort_order;
        $newSortOrder = $validatedData['sort_order'];

        DB::transaction(function () use ($coupon, $validatedData, $oldSortOrder, $newSortOrder) {
            if ($oldSortOrder != $newSortOrder) {
                $this->reorderCoupons($coupon->store_id, $oldSortOrder, $newSortOrder);
            }
            $coupon->update($validatedData);
        });

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    private function reorderCoupons($storeId, $oldSortOrder, $newSortOrder)
    {
        if ($oldSortOrder < $newSortOrder) {
            Coupon::where('store_id', $storeId)
                ->whereBetween('sort_order', [$oldSortOrder + 1, $newSortOrder])
                ->decrement('sort_order');
        } else {
            Coupon::where('store_id', $storeId)
                ->whereBetween('sort_order', [$newSortOrder, $oldSortOrder - 1])
                ->increment('sort_order');
        }
    }

    public function reorder(Request $request)
    {
        $coupons = $request->validate([
            'coupons' => 'required|array',
            'coupons.*.id' => 'required|exists:coupons,id',
            'coupons.*.sort_order' => 'required|integer|min:1',
        ])['coupons'];

        DB::transaction(function () use ($coupons) {
            foreach ($coupons as $couponData) {
                Coupon::where('id', $couponData['id'])->update(['sort_order' => $couponData['sort_order']]);
            }
        });

        return response()->json(['message' => 'Reordering successful']);
    }


    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
