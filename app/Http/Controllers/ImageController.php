<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Store Uploaded Image.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->image;

        Storage::disk('local')->putFileAs('', $image, $image->getClientOriginalName());

        Image::create([
            'image_description' => $request->name,
            'upload_path' => $image->getClientOriginalName()
        ]);
    }
}
