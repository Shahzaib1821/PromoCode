<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json(['error' => 'Query is required'], 400);
        }

        try {
            $results = [
                'store' => $this->searchStores($query),
                'query' => $query,
            ];

            return response()->json($results);
        } catch (\Exception $e) {
            Log::error('Live search error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred during search'], 500);
        }
    }

    private function searchStores($query)
    {
        return Store::where('name', 'LIKE', "%{$query}%")
            ->orWhere('tagline', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'name', 'slug'])
            ->toArray();
    }
}
