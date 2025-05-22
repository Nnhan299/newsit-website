<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/posts'), $filename);
    
            return response()->json(['url' => asset('images/posts/' . $filename)]);
        }
    
        return response()->json(['error' => 'No file uploaded'], 400);
    }
    
}