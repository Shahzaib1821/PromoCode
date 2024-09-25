<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all(); // Ensure this retrieves the data
        return view('backend.pages.slider.index', compact('sliders'));
    }


    public function create()
    {
        return view('backend.pages.slider.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'store_name' => 'required',
            'link' => 'required|url',
            'image_path' => 'required|image|max:2048',
            'logo_path' => 'required|image|max:2048',
        ]);

        $slider = new Slider();
        $slider->title = $validatedData['title'];
        $slider->store_name = $validatedData['store_name'];
        $slider->link = $validatedData['link'];
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sliders/bg'), $imagePath);
            $slider->image_path = $imagePath;
        }

        if ($request->hasFile('logo_path')) {
            $logo = $request->file('logo_path');
            $logoPath = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/sliders/logo'), $logoPath);
            $slider->logo_path = $logoPath;
        }

        $slider->save();

        return redirect()->route('sliders.index');
    }

    public function edit(Slider $slider)
    {
        return view('backend.pages.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'store_name' => 'required',
            'link' => 'required|url',
            'image_path' => 'image|max:2048',
            'logo_path' => 'image|max:2048',
        ]);

        $slider->title = $validatedData['title'];
        $slider->store_name = $validatedData['store_name'];
        $slider->link = $validatedData['link'];
        if ($request->hasFile('image_path')) {
            Storage::delete('public/' . $slider->image_path);
            $slider->image_path = $request->file('image_path')->store('sliders', 'public');
        }
        if ($request->hasFile('logo_path')) {
            Storage::delete('public/' . $slider->logo_path);
            $slider->logo_path = $request->file('logo_path')->store('sliders', 'public');
        }
        $slider->save();

        return redirect()->route('sliders.index');
    }

    public function destroy(Slider $slider)
    {
        Storage::delete('public/' . $slider->image_path);
        Storage::delete('public/' . $slider->logo_path);
        $slider->delete();

        return redirect()->route('sliders.index');
    }
}
