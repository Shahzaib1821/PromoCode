<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('backend.pages.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('backend.pages.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'short_description' => 'required',
            'long_description' => 'required',
            'popular_blog' => 'boolean',
            'status' => 'boolean',
            'top_blog' => 'boolean',
            'featured_blog' => 'boolean',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'faqs' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $validatedData['faqs'] = isset($validatedData['faqs']) ? json_encode($validatedData['faqs']) : null;
        // $validatedData['meta_keywords'] = json_encode($validatedData['meta_keywords']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $imageName);
            $validatedData['image'] =  $imageName;
        }

        Blog::create($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function show(Blog $blogs)
    {
        return view('backend.pages.blogs.show', compact('blogs'));
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        return view('backend.pages.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'short_description' => 'required',
            'long_description' => 'required',
            'popular_blog' => 'boolean',
            'status' => 'boolean',
            'top_blog' => 'boolean',
            'featured_blog' => 'boolean',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'faqs' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $imageName);
            $validatedData['image'] = $imageName;

            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }
        }

        $blog->update($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blogs)
    {
        if ($blogs->image && file_exists(public_path($blogs->image))) {
            unlink(public_path($blogs->image));
        }

        $blogs->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
