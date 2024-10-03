<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.pages.categories.store-categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('backend.pages.categories.store-categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imagePath);
            $category->image = $imagePath;
        }

        if ($request->filled('parent_id')) {
            $category->parent_id = $request->parent_id;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('backend.pages.categories.store-categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->whereNull('parent_id')->get();
        return view('backend.pages.categories.store-categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imagePath);
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ? 1 : 0,
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    public function getCombinedCategories()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $combined = collect();

        foreach ($categories as $category) {
            $combined->push((object)[
                'id' => $category->id,
                'name' => $category->name,
                'is_subcategory' => false
            ]);

            foreach ($category->children as $subcategory) {
                $combined->push((object)[
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'parent_name' => $category->name,
                    'is_subcategory' => true
                ]);
            }
        }

        return $combined;
    }
}
