<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $users = User::paginate(10); // Lấy danh sách người dùng kèm phân trang
    return view('admin.users.index', compact('users'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('admin.users.create');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được thêm thành công!');
}


    /**
     * Display the specified resource.
     */
    // UserController.php

public function showPosts($id)
{
    $user = User::findOrFail($id);
    $posts = $user->posts; // Lấy tất cả bài viết của tác giả

    return view('user.posts', compact('user', 'posts'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update($validated);

    return redirect()->route('admin.users.index')->with('success', 'Thông tin người dùng đã được cập nhật!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa!');
}
    
    

}