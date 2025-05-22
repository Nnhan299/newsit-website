<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;




class AdminController extends Controller
{
    // Trang chủ cho admin
    public function index(){
        if (Auth::check() && Auth::user()->usertype == 'admin') {
            $totalUsers = User::count();  
            $totalPosts = Post::count();  
            $totalCategories = Category::count();
            $recentActivities = Activity::orderBy('created_at', 'desc')->take(5)->get();
        
            return view('admin.index', compact('totalUsers', 'totalPosts', 'totalCategories', 'recentActivities'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Bạn không có quyền truy cập!');
        }

        return redirect()->route('login');
    }

    // Hiển thị danh sách danh mục
    public function showCategories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Hiển thị form tạo danh mục
    public function createCategory()
    {
        return view('admin.categories.create');
    }

    // Lưu danh mục mới
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Tạo danh mục thành công.');
    }

    // Hiển thị form chỉnh sửa danh mục
    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Cập nhật danh mục thành công.');
    }

    // Xóa danh mục
    public function deleteCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Xóa danh mục thành công.');
    }

    // Hiển thị danh sách người dùng
    public function showUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Hiển thị form tạo người dùng mới
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Lưu người dùng mới
    public function storeUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:users,name',
        'email' => 'required|email|max:255|unique:users,email',
        'phone' => 'required|numeric|digits:10|unique:users,phone',
        'password' => 'required|min:8|confirmed',
    ]);
    

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usertype' => 'user',
        ]);

        // Ghi hoạt động vào bảng Activity
        Activity::create([
            'activity_type' => 'create',
            'model_type' => User::class,
            'model_id' => $user->id,
            'details' => 'A new user was created.',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Đăng ký thành công! Chào mừng bạn đến với trang dashboard.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors('Failed to create user: ' . $e->getMessage());
    }
}


    // Hiển thị form chỉnh sửa người dùng
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    // Xóa người dùng
    public function deleteUser(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'Cannot delete your own account!');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    // Hiển thị danh sách bài viết
    public function showPosts()
    {
        $posts = Post::all(); // Lấy tất cả bài viết
        return view('admin.posts.index', compact('posts'));
    }

    // Hiển thị form tạo bài viết
    public function createPost()
    {
        return view('admin.posts.create');
    }

   // Lưu bài viết mới
   public function storePost(Request $request)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'content' => 'required',
           'category_id' => 'nullable|exists:categories,id',
           'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048' 
       ]);
   
       $imagePath = null;
   
       // Xử lý ảnh nếu có
       if ($request->hasFile('image')) {
           $imagePath = $request->file('image')->store('images', 'public');
       }
   
       // Tạo bài viết mới
       $post = Post::create([
           'title' => $request->title,
           'content' => $request->content,
           'category_id' => $request->category_id,
           'author_id' => Auth::user()->id,  // Gán author_id là ID của người dùng hiện tại
           'image' => $imagePath,  // Lưu đường dẫn ảnh
       ]);
   
       // Chuyển hướng với thông báo thành công
       return redirect()->route('admin.posts')->with('success', 'Bài viết đã được tạo thành công!');
   }
   


    // Hiển thị form chỉnh sửa bài viết
    public function editPost(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // Cập nhật bài viết
    public function updatePost(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.posts')->with('success', 'Bài viết đã được cập nhật!');
    }

    // Xóa bài viết
    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts')->with('success', 'Bài viết đã được xóa!');
    }
    public function show($id)
    {
        $post = Post::find($id);
        $authorName = $post->author->name; // Truy vấn tên tác giả thông qua mối quan hệ
// Đảm bảo có quan hệ với 'author'
        return view('posts.show', compact('post'));
    }
    public function dashboard()
{
    $newComments = Comment::where('is_read', false)
    ->with(['post', 'user']) // Load quan hệ để sử dụng trong view
    ->orderBy('created_at', 'desc')
    ->get();

dd($newComments);
    return view('admin.index', compact('newComments'));
}
public function markCommentAsRead(Comment $comment)
{
    $comment->update(['is_read' => true]);
    return redirect()->route('admin.index')->with('success', 'Bình luận đã được đánh dấu là đã đọc.');
}

}