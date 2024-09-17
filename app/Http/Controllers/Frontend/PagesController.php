<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function footerStores(){
        $stores = Store::where('popular_stores', true)->where('status', 1)->get();
        return view('frontend.layouts.includes.footer', compact('stores'));
    }
    public function home()
    {
        $categories = Category::where('status', 1)->get();
        $stores = Store::where('status', 1)->get();
        $mainBlog = Blog::where('id', 1)->where('status', 1)->get();
        $blogPosts = Blog::where('top_blog', true)->where('status', 1)->get();
        return view('frontend.pages.home', compact('categories', 'stores', 'mainBlog', 'blogPosts'));
    }


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
        // popoluar sotres will be visileon this page
        $popularStores = Store::where('popular_stores', true)->get();

        return view('frontend.pages.write-for-us', compact('popularStores'));
    }
    public function privacyPolicy()
    {
        // popoluar sotres will be visileon this page
        $popularStores = Store::where('popular_stores', true)->get();

        return view('frontend.pages.privacy-policy', compact('popularStores'));
    }

    public function blogs(Request $request)
    {
        $query = Blog::where('status', 1)->latest();
        $categories = Category::where('status', 1)->get();

        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->where('status', 1)->firstOrFail();
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
        $categories = Category::all();
        $recentBlogs = Blog::latest()->take(5)->get();
        $blog = Blog::where('slug', $slug)->firstOrFail();

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
        // popoluar sotres will be visileon this page
        $popularStores = Store::where('popular_stores', true)->get();

        return view('frontend.pages.saving-tips', compact('popularStores'));
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
    public function storeDetail($slug)
    {
        $store = Store::where('slug', $slug)->where('status', 1)->firstOrFail();
        $popularStores = Store::where('popular_stores', true)->where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $coupons = $store->coupons->where('status', 1);

        $metaTitle = htmlspecialchars($store->meta_title, ENT_QUOTES, 'UTF-8');
        $metaDescription = htmlspecialchars($store->meta_description, ENT_QUOTES, 'UTF-8');

        $metaKeywords = $store->meta_keywords;
        if (is_string($metaKeywords)) {
            $metaKeywords = json_decode($metaKeywords, true) ?? [];
        } elseif (!is_array($metaKeywords)) {
            $metaKeywords = [];
        }
        $metaKeywords = htmlspecialchars(implode(', ', $metaKeywords), ENT_QUOTES, 'UTF-8');

        $faqs = $store->faqs;
        if (is_string($faqs)) {
            $faqs = json_decode($faqs, true) ?? [];
        } elseif (!is_array($faqs)) {
            $faqs = [];
        }

        return view('frontend.pages.store-detail', [
            'store' => $store,
            'popularStores' => $popularStores,
            'categories' => $categories,
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
