<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('backend.pages.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.pages.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desktop_image' => 'required|image',
            'mobile_image' => 'required|image',
            'link' => 'nullable|url',
            'type' => 'required|in:event,sale',
            'is_active' => 'required|in:0,1',
        ]);

       if ($request->hasFile('desktop_image')) {
            $desktopImage = $request->file('desktop_image');
            $desktopImageName = time() . '_desktop.' . $desktopImage->getClientOriginalExtension();
            $desktopImage->move(public_path('uploads/banners'), $desktopImageName);
            $desktopImagePath = $desktopImageName;
        }

        if ($request->hasFile('mobile_image')) {
            $mobileImage = $request->file('mobile_image');
            $mobileImageName = time() . '_mobile.' . $mobileImage->getClientOriginalExtension();
            $mobileImage->move(public_path('uploads/banners'), $mobileImageName);
            $mobileImagePath = $mobileImageName;
        }

        Banner::create([
            'title' => $request->title,
            'desktop_image' => $desktopImagePath,
            'mobile_image' => $mobileImagePath,
            'link' => $request->link,
            'type' => $request->type,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('backend.pages.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'desktop_image' => 'nullable|image',
            'mobile_image' => 'nullable|image',
            'link' => 'nullable|url',
            'type' => 'required|in:event,sale',
            'is_active' => 'required|in:0,1',
        ]);

        $data = $request->except(['desktop_image', 'mobile_image']);

        if ($request->hasFile('desktop_image')) {
            if ($banner->desktop_image && file_exists(public_path($banner->desktop_image))) {
                unlink(public_path($banner->desktop_image));
            }

            $desktopImage = $request->file('desktop_image');
            $desktopImageName = time() . '_desktop.' . $desktopImage->getClientOriginalExtension();
            $desktopImage->move(public_path('uploads/banners'), $desktopImageName);
            $desktopImagePath = $desktopImageName;

            $banner->desktop_image = $desktopImagePath;
        }

        if ($request->hasFile('mobile_image')) {
            if ($banner->mobile_image && file_exists(public_path($banner->mobile_image))) {
                unlink(public_path($banner->mobile_image));
            }

            $mobileImage = $request->file('mobile_image');
            $mobileImageName = time() . '_mobile.' . $mobileImage->getClientOriginalExtension();
            $mobileImage->move(public_path('uploads/banners'), $mobileImageName);
            $mobileImagePath = $mobileImageName;

            $banner->mobile_image = $mobileImagePath;
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
    }
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
    }
}
