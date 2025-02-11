<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required'
        ]);

        $imagePath = $request->file('image')->store('banners', 'public');

        Banner::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner added successfully.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $banner->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        
        return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
    }

    public function updateImage(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($banner->image) {
            Storage::delete('public/banners/' . $banner->image);
        }

        $imagePath = $request->file('image')->store('public/banners');
        $imageName = basename($imagePath);

        $banner->update(['image' => $imageName]);

        return response()->json([
            'success' => true,
            'image_url' => asset('storage/banners/' . $imageName),
        ]);
    }

    public function show(Banner $banner)
    {
        return response()->json($banner);
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->image);
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
    }
}
