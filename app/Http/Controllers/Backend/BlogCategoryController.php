<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $blogcategories = BlogCategory::all();
        return view('backend.pages.categories.blog-categories.index', compact('blogcategories'));
    }

    public function create()
    {
        return view('backend.pages.categories.blog-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('blogcategories.index')->with('success', 'Category created successfully.');
    }


    public function edit(BlogCategory $blogCategory)
    {
        return view('backend.pages.categories.blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $blogCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('blogcategories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route('blogcategories.index')->with('success', 'Category deleted successfully.');
    }
}
