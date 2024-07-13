<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Image::create([
            'url' => $imagePath,
            'title' => $request->title,
            'tag' => $request->tag,
        ]);

        return redirect()->route('images.index');
    }

    public function edit(Image $image)
    {
        return view('images.edit', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($image->url);
            $imagePath = $request->file('image')->store('images', 'public');
            $image->update(['url' => $imagePath]);
        }

        $image->update([
            'title' => $request->title,
            'tag' => $request->tag,
        ]);

        return redirect()->route('images.index');
    }

    public function destroy(Image $image)
    {
        Storage::disk('public')->delete($image->url);
        $image->delete();

        return redirect()->route('images.index');
    }
}
