<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Store;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('frontend.pages.home', compact('categories', 'stores'));
    }

    public function category(Request $request)
    {
        $categories = Category::all();
        $stores = Store::with('category')->get();
        $activeCategory = $request->query('active') ?: $categories->first()->slug;

        return view('frontend.pages.categories', compact('categories', 'stores', 'activeCategory'));
    }

    public function store()
    {
        $stores = Store::all();

        // Organize stores by the first letter of their name
        $organizedStores = [];
        foreach ($stores as $store) {
            $firstLetter = strtoupper(substr($store->name, 0, 1));
            if (!isset($organizedStores[$firstLetter])) {
                $organizedStores[$firstLetter] = [];
            }
            $organizedStores[$firstLetter][] = $store;
        }
        ksort($organizedStores);

        return view('frontend.pages.stores', compact('organizedStores'));
    }
    // public function storeDetail($slug)
    // {
    //     $store = Store::where('slug', $slug)->firstOrFail();
    //     $popularStores = Store::where('popular_stores', true)->get();

    //     $metaTitle = htmlspecialchars($store->meta_title, ENT_QUOTES, 'UTF-8');
    //     $metaDescription = htmlspecialchars($store->meta_description, ENT_QUOTES, 'UTF-8');
    //     $metaKeywords = htmlspecialchars(implode(', ', json_decode($store->meta_keywords, true)), ENT_QUOTES, 'UTF-8');

    //     return view('frontend.pages.store-detail', [
    //         'store' => $store,
    //         'popularStores' => $popularStores,
    //         'metaTitle' => $metaTitle,
    //         'metaDescription' => $metaDescription,
    //         'metaKeywords' => $metaKeywords
    //     ]);
    // }

    public function storeDetail($slug)
    {
        // Retrieve the store by its slug
        $store = Store::where('slug', $slug)->firstOrFail();

        // Retrieve popular stores
        $popularStores = Store::where('popular_stores', true)->get();

        // Retrieve coupons associated with the store
        $coupons = $store->coupons; // Assuming you have a relationship defined in the Store model

        // Handle meta information
        $metaTitle = htmlspecialchars($store->meta_title, ENT_QUOTES, 'UTF-8');
        $metaDescription = htmlspecialchars($store->meta_description, ENT_QUOTES, 'UTF-8');

        // Handle meta_keywords whether it's a JSON string or an array
        $metaKeywords = $store->meta_keywords;
        if (is_string($metaKeywords)) {
            $metaKeywords = json_decode($metaKeywords, true) ?? [];
        } elseif (!is_array($metaKeywords)) {
            $metaKeywords = [];
        }
        $metaKeywords = htmlspecialchars(implode(', ', $metaKeywords), ENT_QUOTES, 'UTF-8');

        // Handle FAQs
        $faqs = $store->faqs;
        if (is_string($faqs)) {
            $faqs = json_decode($faqs, true) ?? [];
        } elseif (!is_array($faqs)) {
            $faqs = [];
        }

        return view('frontend.pages.store-detail', [
            'store' => $store,
            'popularStores' => $popularStores,
            'coupons' => $coupons,
            'metaTitle' => $metaTitle,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'faqs' => $faqs
        ]);
    }

    public function coupons()
    {
        return view('frontend.pages.coupons');
    }
}
