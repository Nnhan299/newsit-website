<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate file upload
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Lưu ảnh vào thư mục "images/posts" trong storage
        $imagePath = $request->file('image')->store('images/posts', 'public');

        // Trả về đường dẫn của ảnh đã upload
        return response()->json([
            'success' => true,
            'image_path' => Storage::url($imagePath),
        ]);
    }
}