<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DealController extends Controller
{
    public function index(Request $request)
    {
        $deals = Deal::with('store.subcategory.category', 'creator', 'updater')->get();
        return view('backend.pages.deals.index', compact('deals'));
    }

    public function create()
    {
        $stores = Store::all();
        return view('backend.pages.deals.create', compact('stores'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'store_id' => 'required|exists:stores,id',
            'discounted_price' => 'required|string|max:255',
            'expiry_date' => 'required|date',
            'created_date' => 'required|date',
            'affiliated_link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'deal_exclusive' => 'boolean',
            'verify' => 'boolean',
            'top_deal' => 'boolean',
        ]);

        // Create the deal using validated data
        $deal = Deal::create($validatedData);

        return redirect()->route('deals.index')->with('success', 'Deal created successfully.');
    }

    public function edit(Deal $deal)
    {
        $stores = Store::all();
        return view('backend.pages.deals.edit', compact('deal', 'stores'));
    }

    public function update(Request $request, Deal $deal)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'store_id' => 'required|exists:stores,id',
            'discounted_price' => 'required|string|max:255',
            'expiry_date' => 'required|date',
            'created_date' => 'required|date',
            'affiliated_link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
            'description' => 'required|string',
            'deal_exclusive' => 'nullable|boolean',
            'verify' => 'nullable|boolean',
            'top_deal' => 'nullable|boolean',
            'sort_order' => 'required|integer|min:1',
        ]);

        // Update the boolean fields based on request input
        $validatedData['deal_exclusive'] = $request->has('deal_exclusive') ? 1 : 0;
        $validatedData['verify'] = $request->has('verify') ? 1 : 0;
        $validatedData['top_deal'] = $request->has('top_deal') ? 1 : 0;
        $validatedData['updated_by'] = Auth::id();

        $oldSortOrder = $deal->sort_order;
        $newSortOrder = $validatedData['sort_order'];

        DB::transaction(function () use ($deal, $validatedData, $oldSortOrder, $newSortOrder) {
            if ($oldSortOrder != $newSortOrder) {
                $this->reorderDeals($deal->store_id, $oldSortOrder, $newSortOrder);
            }
            $deal->update($validatedData);
        });

        return redirect()->route('deals.index')->with('success', 'Deal updated successfully.');
    }


    private function reorderDeals($storeId, $oldSortOrder, $newSortOrder)
    {
        if ($oldSortOrder < $newSortOrder) {
            Deal::where('store_id', $storeId)
                ->whereBetween('sort_order', [$oldSortOrder + 1, $newSortOrder])
                ->decrement('sort_order');
        } else {
            Deal::where('store_id', $storeId)
                ->whereBetween('sort_order', [$newSortOrder, $oldSortOrder - 1])
                ->increment('sort_order');
        }
    }

    public function reorder(Request $request)
    {
        $deals = $request->validate([
            'deals' => 'required|array',
            'deals.*.id' => 'required|exists:deals,id',
            'deals.*.sort_order' => 'required|integer|min:1',
        ])['deals'];

        DB::transaction(function () use ($deals) {
            foreach ($deals as $dealData) {
                Deal::where('id', $dealData['id'])->update(['sort_order' => $dealData['sort_order']]);
            }
        });

        return response()->json(['message' => 'Reordering successful']);
    }

    public function destroy(Deal $deal)
    {
        $deal->delete();

        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully.');
    }
}
