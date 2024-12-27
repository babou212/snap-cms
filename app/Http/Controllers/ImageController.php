<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Inertia\Inertia;

class ImageController extends Controller
{
    /**
     * Passes Images to image page.
     */
    public function show()
    {
       $images = Image::all(); 

       return Inertia::render('ImagePage/ImagePage', [
        'images' => $images
       ]);
    }

    /**
     * Store Uploaded Image.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:25600',
        ]);

        $image = $request->image;

        Storage::disk('local')->putFileAs('', $image, $image->getClientOriginalName());

        Image::create([
            'image_description' => $request->image_description,
            'upload_path' => $image->getClientOriginalName()
        ]);
    }

    /**
     * Delete Image.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $image = json_decode($request->image, true);

        Storage::delete($image['upload_path']);

        Image::where('id', $image['id'])->delete();
    }
}
