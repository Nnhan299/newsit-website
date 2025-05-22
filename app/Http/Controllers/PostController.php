<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Danh sách bài viết
    public function index()
    {
        $posts = Post::with('category')->get(); // Lấy tất cả bài viết cùng danh mục liên quan
        return view('admin.posts.index', compact('posts'));
    }

    // Hiển thị chi tiết bài viết
    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id); // Lấy bài viết theo ID, kèm danh mục
        return view('admin.posts.show', compact('post'));
    }

    // Form thêm bài viết
    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục để chọn
        return view('admin.posts.create', compact('categories'));
    }

    // Lưu bài viết
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $filename = null;


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            
            $file->move(public_path('images/posts'), $filename);
        }


        // Tạo bài viết
        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => $validated['author'],
            'category_id' => $validated['category_id'],
            'image' => $filename ? 'posts/' . $filename : null, // Lưu đường dẫn ảnh
        ]);

        // Chuyển hướng về trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được tạo thành công!');
    }

    // Form chỉnh sửa bài viết
    public function edit(Post $post)
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    // Cập nhật bài viết
    public function update(Request $request, Post $post)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
    // Xóa ảnh cũ nếu có
    if ($post->image && file_exists(public_path($post->image))) {
        unlink(public_path($post->image));
    }

    $image = $request->file('image');
    $filename = time() . '.' . $image->getClientOriginalExtension();

    // Lưu ảnh mới vào thư mục public/images/posts
    $image->move(public_path('images/posts'), $filename);

    // Cập nhật đường dẫn ảnh
    $post->image = 'images/posts/' . $filename;
}


        // Cập nhật dữ liệu khác
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => $validated['author'],
            'category_id' => $validated['category_id'],
        ]);

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    // Xóa bài viết
    public function destroy(Post $post)
    {
        // Xóa ảnh nếu có
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Xóa bài viết
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa thành công!');
    }
    public function storeComment(Request $request, $postId)  
{  
    $request->validate([  
        'content' => 'required|string|max:500',  
    ]);  

    Comment::create([  
        'content' => $request->content,  
        'post_id' => $postId,  
        'user_id' => Auth::id(),  
    ]);  

    return redirect()->back()->with('success', 'Bình luận đã được thêm!');  
}  

}