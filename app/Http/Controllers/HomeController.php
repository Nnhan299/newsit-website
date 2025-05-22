<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5); // Lấy bài viết mới nhất, giới hạn 5 bài mỗi trang
        return view('welcome', compact('posts'));
    }
}