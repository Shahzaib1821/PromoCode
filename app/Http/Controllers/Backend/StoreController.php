<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        $category = Category::all();
        return view('backend.pages.stores.index', compact('stores'));
    }

    public function show($slug)
    {
        $store = Store::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.store-detail', compact('store'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.stores.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:stores',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tagline' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'top_stores' => 'boolean',
            'top_brands' => 'boolean',
            'popular_stores' => 'boolean',
            'status' => 'boolean',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required|string',
            'faqs.*.answer' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|array',
            'meta_keywords.*' => 'string',
            'savings' => 'nullable|string|max:255',
            'discount' => 'nullable|string|max:255',
            'free_shipping' => 'nullable|string|max:255',
        ]);

        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/stores'), $imagePath);
                $validatedData['image'] = $imagePath;
            }

            $validatedData['faqs'] = isset($validatedData['faqs']) ? json_encode($validatedData['faqs']) : null;
            $validatedData['meta_keywords'] = json_encode($validatedData['meta_keywords']);

            $validatedData['top_stores'] = $request->has('top_stores');
            $validatedData['top_brands'] = $request->has('top_brands');
            $validatedData['popular_stores'] = $request->has('popular_stores');
            $validatedData['status'] = $request->has('status');

            $store = Store::create($validatedData);

            return redirect()->route('store.index')->with('success', 'Store created successfully.');
        } catch (\Exception $e) {
            // If an error occurs, delete the uploaded image if it exists
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the store. Please try again.');
        }
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        $categories = Category::all();
        return view('backend.pages.stores.edit', compact('store', 'categories'));
    }

    public function update(Request $request, Store $store)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:stores,slug,' . $store->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tagline' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'top_stores' => 'boolean',
        'top_brands' => 'boolean',
        'popular_stores' => 'boolean',
        'status' => 'boolean',
        'faqs' => 'nullable|array',
        'faqs.*.question' => 'required|string',
        'faqs.*.answer' => 'required|string',
        'meta_title' => 'required|string|max:255',
        'meta_description' => 'required|string',
        'meta_keywords' => 'required|string',
        'savings' => 'nullable|string|max:255',
        'discount' => 'nullable|string|max:255',
        'free_shipping' => 'nullable|string|max:255',
    ]);

    try {
        // Handle image upload
        if ($request->hasFile('image')) {
            if ($store->image) {
                if (file_exists(public_path($store->image))) {
                    unlink(public_path($store->image));
                }
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/stores'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Process boolean fields
        $validatedData['top_stores'] = $request->has('top_stores');
        $validatedData['top_brands'] = $request->has('top_brands');
        $validatedData['popular_stores'] = $request->has('popular_stores');
        $validatedData['status'] = $request->has('status');

        // Process FAQs
        if (isset($validatedData['faqs'])) {
            $validatedData['faqs'] = json_encode($validatedData['faqs']);
        } else {
            $validatedData['faqs'] = null;
        }

        // Process meta keywords
        $validatedData['meta_keywords'] = json_encode(explode(',', $validatedData['meta_keywords']));

        // Update the store
        $store->update($validatedData);

        return redirect()->route('store.index')->with('success', 'Store updated successfully.');
    } catch (\Exception $e) {
        // If an error occurs and a new image was uploaded, delete it
        if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()->back()->withInput()->with('error', 'An error occurred while updating the store. Please try again.');
    }
}
    public function destroy($id)
    {
        $store = Store::findOrFail($id);

        // Remove the image if it exists
        if ($store->image) {
            Storage::disk('public')->delete('uploads/stores/' . $store->image);
        }

        $store->delete();

        return redirect()->route('store.index')->with('success', 'Store deleted successfully.');
    }
}
