<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        // Validate the image
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the uploaded image in the 'public' disk
        $filePath = $request->file('upload')->store('uploads', 'public');

        // Return the image URL for CKEditor to display
        $url = Storage::url($filePath);

        return response()->json([
            'url' => $url,
        ]);
    }
}
