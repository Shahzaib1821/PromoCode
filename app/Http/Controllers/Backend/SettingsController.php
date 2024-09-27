<?php

// app/Http/Controllers/Backend/SettingsController.php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    private $defaultSettings = [
        'site_title' => 'Default Title',
        'primary_color' => '#5f1899',
        'secondary_color' => '#7720db',
        'primary_button_color' => '#009599',
        'secondary_button_color' => '#f0f0f0',
        'logo_max_width' => 200,
        'h1_font_size' => '32',
        'h2_font_size' => '28',
        'h3_font_size' => '24',
        'h4_font_size' => '20',
        'h5_font_size' => '18',
        'h6_font_size' => '16',
        'p_font_size' => '16',
        'span_font_size' => '14',
    ];
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('backend.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->except('_token', 'header_logo', 'footer_logo');

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('header_logo')) {
            // Store the header logo directly in the public directory
            $headerLogoPath = $request->file('header_logo')->move(public_path('uploads/logos'), $request->file('header_logo')->getClientOriginalName());
            Setting::updateOrCreate(['key' => 'header_logo'], ['value' => 'logos/' . $request->file('header_logo')->getClientOriginalName()]);
        }

        if ($request->hasFile('footer_logo')) {
            // Store the footer logo directly in the public directory
            $footerLogoPath = $request->file('footer_logo')->move(public_path('uploads/logos'), $request->file('footer_logo')->getClientOriginalName());
            Setting::updateOrCreate(['key' => 'footer_logo'], ['value' => 'logos/' . $request->file('footer_logo')->getClientOriginalName()]);
        }


        return redirect()->back()->with('success', 'Settings updated successfully');
    }
    public function reset()
    {
        foreach ($this->defaultSettings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Settings have been reset to default values');
    }
}
