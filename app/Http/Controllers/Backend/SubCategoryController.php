<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();
        return view('backend.pages.categories.subcategories.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.categories.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        SubCategory::create($request->all());

        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully.');
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('backend.pages.categories.subcategories.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subCategory->update($request->all());

        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully.');
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();

        return redirect()->route('subcategories.index')->with('success', 'SubCategory deleted successfully.');
    }
}
