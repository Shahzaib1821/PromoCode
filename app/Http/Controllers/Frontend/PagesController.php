<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Deal;
use App\Models\Slider;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function footerStores()
    {
        $stores = Store::where('popular_stores', true)->where('status', 1)->get();
        return view('frontend.layouts.includes.footer', compact('stores'));
    }
    public function home()
    {
        $categories = Category::where('status', 1)->where('parent_id', null)->take(7)->get();
        $stores = Store::where('status', 1)->get();
        $mainBlog = Blog::where('featured_blog', true)->where('status', 1)->get();
        $blogPosts = Blog::where('top_blog', true)->where('status', 1)->get();
        $saleBanner = Banner::where('is_active', true)->where('type', 'sale')->first();
        $eventBanner = Banner::where('is_active', true)->where('type', 'event')->first();
        $sliders = Slider::all();
        $deals = Coupon::where('status', 1)->where('coupon_code', null)->take(8)->get();
        return view('frontend.pages.home', compact('categories', 'stores', 'mainBlog', 'blogPosts', 'saleBanner', 'eventBanner', 'sliders', 'deals'));
    }

    public function blogs(Request $request)
    {
        $query = Blog::where('status', 1)->latest();
        $categories = BlogCategory::where('status', 1)->get();

        if ($request->has('category')) {
            $category = BlogCategory::where('slug', $request->category)->where('status', 1)->firstOrFail();
            $query->where('category_id', $category->id);
        }

        if ($request->has('archive')) {
            $date = Carbon::createFromFormat('Y-m', $request->archive);
            $query->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month);
        }

        $blogs = $query->paginate(6);
        $recentBlogs = Blog::where('status', 1)->latest()->take(5)->get();
        $archives = Blog::selectRaw('YEAR(created_at) year, MONTH(created_at) month')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get()
            ->map(function ($item) {
                return Carbon::createFromDate($item->year, $item->month, 1)->format('F Y');
            });

        return view('frontend.pages.blogs', compact('blogs', 'recentBlogs', 'categories', 'archives'));
    }

    public function blogDetail($slug)
    {
        $categories = BlogCategory::all();
        $recentBlogs = Blog::latest()->take(5)->get();
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $popularBlogs = Blog::where('popular_blog', true)->latest()->take(5)->get();;
        // Get unique archive dates
        $archives = Blog::selectRaw('YEAR(created_at) year, MONTH(created_at) month')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get()
            ->map(function ($item) {
                return Carbon::createFromDate($item->year, $item->month, 1)->format('F Y');
            });

        $metaTitle = htmlspecialchars($blog->meta_title, ENT_QUOTES, 'UTF-8');
        $metaDescription = htmlspecialchars($blog->meta_description, ENT_QUOTES, 'UTF-8');

        $metaKeywords = $blog->meta_keywords;
        if (is_string($metaKeywords)) {
            $metaKeywords = json_decode($metaKeywords, true) ?? [];
        } elseif (!is_array($metaKeywords)) {
            $metaKeywords = [];
        }
        $metaKeywords = htmlspecialchars(implode(', ', $metaKeywords), ENT_QUOTES, 'UTF-8');

        $faqs = $blog->faqs;
        if (is_string($faqs)) {
            $faqs = json_decode($faqs, true) ?? [];
        } elseif (!is_array($faqs)) {
            $faqs = [];
        }

        return view(
            'frontend.pages.blog-detail',
            [
                'blog' => $blog,
                'recentBlogs' => $recentBlogs,
                'popularBlogs' => $popularBlogs,
                'categories' => $categories,
                'archives' => $archives,
                'metaTitle' => $metaTitle,
                'metaDescription' => $metaDescription,
                'metaKeywords' => $metaKeywords,
                'faqs' => $faqs
            ],
            compact('blog', 'categories', 'recentBlogs', 'archives')
        );
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $blogs = Blog::where('name', 'LIKE', "%{$query}%")
            ->orWhere('short_description', 'LIKE', "%{$query}%")
            ->paginate(6);

        $categories = Category::all();
        $recentBlogs = Blog::latest()->take(5)->get();

        // Get unique archive dates
        $archives = Blog::selectRaw('YEAR(created_at) year, MONTH(created_at) month')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get()
            ->map(function ($item) {
                return Carbon::createFromDate($item->year, $item->month, 1)->format('F Y');
            });

        return view('frontend.pages.blogs', compact('blogs', 'categories', 'recentBlogs', 'archives', 'query'));
    }
    public function savingTips()
    {
        $popularStores = Store::where('popular_stores', true)->get();

        return view('frontend.pages.saving-tips', compact('popularStores'));
    }

    // public function category(Request $request)
    // {
    //     $categories = Category::with(['subcategories', 'stores'])
    //         ->whereNull('parent_id')
    //         ->orWhere('parent_id', 0)
    //         ->get();

    //     foreach ($categories as $category) {
    //         $category->allStores = $category->stores->concat(
    //             $category->subcategories->flatMap->stores
    //         )->unique('id');
    //     }

    //     return view('frontend.pages.categories', compact('categories'));
    // }

    public function category(Request $request)
    {
        // Load categories with subcategories and stores (eager load relationships)
        $categories = Category::with(['subcategories', 'stores'])->whereNull('parent_id')->get();

        // For each category, get all stores directly assigned to it and its subcategories
        foreach ($categories as $category) {
            // Get stores directly assigned to the category
            $categoryStores = $category->stores;

            // Get stores assigned to its subcategories (if any)
            $subcategoryStores = $category->subcategories->flatMap(function ($subcategory) {
                return $subcategory->stores;
            });

            // Merge stores and ensure they are unique
            $category->allStores = $categoryStores->merge($subcategoryStores)->unique('id');
        }

        // Return the view with the categories and their respective stores
        return view('frontend.pages.categories', compact('categories'));
    }


    public function store()
    {
        $stores = Store::all();
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
    //     $store = Store::where('slug', $slug)->where('status', 1)->firstOrFail();
    //     $popularStores = Store::where('popular_stores', true)->where('status', 1)->get();
    //     $category = $store->category;

    //     // Fetch the category associated with the store
    //     $category = $store->category;

    //     // Check if the store has a subcategory
    //     if ($store->subcategory) {
    //         // If the store has a subcategory, fetch related stores from that subcategory
    //         $relatedStores = Store::where('subcategory_id', $store->subcategory->id)
    //             ->where('id', '!=', $store->id)
    //             ->where('status', 1)
    //             ->get();
    //     } elseif ($category) {
    //         // If there is no subcategory, fall back to fetching related stores from the main category
    //         $relatedStores = Store::where('category_id', $category->id)
    //             ->where('id', '!=', $store->id)
    //             ->where('status', 1)
    //             ->get();
    //     } else {
    //         // If no category or subcategory, return an empty collection
    //         $relatedStores = collect();
    //     }
    //     $coupons = $store->coupons()
    //         ->where('status', 1)
    //         ->orderBy('sort_order', 'asc')
    //         ->get();

    //     $metaTitle = htmlspecialchars($store->meta_title, ENT_QUOTES, 'UTF-8');
    //     $metaDescription = htmlspecialchars($store->meta_description, ENT_QUOTES, 'UTF-8');

    //     $metaKeywords = $store->meta_keywords;
    //     if (is_string($metaKeywords)) {
    //         $metaKeywords = json_decode($metaKeywords, true) ?? [];
    //     } elseif (!is_array($metaKeywords)) {
    //         $metaKeywords = [];
    //     }
    //     $metaKeywords = htmlspecialchars(implode(', ', $metaKeywords), ENT_QUOTES, 'UTF-8');

    //     $faqs = $store->faqs;
    //     if (is_string($faqs)) {
    //         $faqs = json_decode($faqs, true) ?? [];
    //     } elseif (!is_array($faqs)) {
    //         $faqs = [];
    //     }

    //     return view('frontend.pages.store-detail', [
    //         'store' => $store,
    //         'popularStores' => $popularStores,
    //         'relatedStores' => $relatedStores,
    //         'coupons' => $coupons,
    //         'metaTitle' => $metaTitle,
    //         'metaDescription' => $metaDescription,
    //         'metaKeywords' => $metaKeywords,
    //         'faqs' => $faqs
    //     ]);
    // }

    public function storeDetail($slug)
    {
        // Fetch the store by slug
        $store = Store::where('slug', $slug)->where('status', 1)->firstOrFail();

        // Fetch popular stores
        $popularStores = Store::where('popular_stores', true)->where('status', 1)->get();

        // Initialize relatedStores as an empty collection
        $relatedStores = collect();

        // Check if the store has a subcategory
        if ($store->subcategory) {
            // If the store has a subcategory, fetch related stores from that subcategory
            $relatedStores = Store::where('subcategory_id', $store->subcategory->id)
                ->where('id', '!=', $store->id)
                ->where('status', 1)
                ->get();
        } else {
            // If there is no subcategory, we can still fetch related stores from the main category
            // This block is optional if you only want to show related stores based on the subcategory
            // Uncomment the following lines if you want to show stores from the main category when no subcategory exists.
            /*
        if ($store->category) {
            $relatedStores = Store::where('category_id', $store->category->id)
                ->where('id', '!=', $store->id)
                ->where('status', 1)
                ->get();
        }
        */
        }

        // Fetch coupons associated with the store
        $coupons = $store->coupons()
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Prepare meta tags
        $metaTitle = htmlspecialchars($store->meta_title, ENT_QUOTES, 'UTF-8');
        $metaDescription = htmlspecialchars($store->meta_description, ENT_QUOTES, 'UTF-8');

        $metaKeywords = $store->meta_keywords;
        if (is_string($metaKeywords)) {
            $metaKeywords = json_decode($metaKeywords, true) ?? [];
        } elseif (!is_array($metaKeywords)) {
            $metaKeywords = [];
        }
        $metaKeywords = htmlspecialchars(implode(', ', $metaKeywords), ENT_QUOTES, 'UTF-8');

        // Prepare FAQs
        $faqs = $store->faqs;
        if (is_string($faqs)) {
            $faqs = json_decode($faqs, true) ?? [];
        } elseif (!is_array($faqs)) {
            $faqs = [];
        }

        // Return the store detail view with the relevant data
        return view('frontend.pages.store-detail', [
            'store' => $store,
            'popularStores' => $popularStores,
            'relatedStores' => $relatedStores,
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


    // Footer Pages


    public function about()
    {
        $popularStores = Store::where('popular_stores', true)->where('status', 1)->get();
        return view('frontend.pages.about', compact('popularStores'));
    }
    public function termsConditions()
    {
        $popularStores = Store::where('popular_stores', true)->where('status', 1)->get();
        return view('frontend.pages.terms-and-conditions', compact('popularStores'));
    }
    public function faq()
    {
        $popularStores = Store::where('popular_stores', true)->where('status', 1)->get();
        return view('frontend.pages.terms-and-conditions', compact('popularStores'));
    }
    public function shipping()
    {
        $popularStores = Store::where('popular_stores', true)->where('status', 1)->get();
        return view('frontend.pages.terms-and-conditions', compact('popularStores'));
    }

    public function writeForUs()
    {
        $popularStores = Store::where('popular_stores', true)->get();

        return view('frontend.pages.write-for-us', compact('popularStores'));
    }
    public function privacyPolicy()
    {
        $popularStores = Store::where('popular_stores', true)->get();

        return view('frontend.pages.privacy-policy', compact('popularStores'));
    }

    public function apiSearch(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        if (strlen($query) >= 2) {
            $results = Blog::where('name', 'LIKE', "%{$query}%")
                ->orWhere('short_description', 'LIKE', "%{$query}%")
                ->take(10)
                ->get()
                ->map(function ($blog) {
                    return [
                        'id' => $blog->id,
                        'name' => $blog->name,
                        'url' => route('blog.detail', $blog->slug)
                    ];
                });
        }

        return response()->json($results);
    }
}
