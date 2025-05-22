<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.categories.index', compact('categories')); // Trả về view với các danh mục
    }

    // Hiển thị form thêm mới danh mục
    public function create()
    {
        return view('admin.categories.create'); // Trả về form tạo danh mục mới
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        // Validate dữ liệu form
        $request->validate([
            'name' => 'required|string|max:255|unique:categories', // Kiểm tra tính duy nhất
        ]);

        // Tạo danh mục mới
        Category::create([
            'name' => $request->name,
        ]);

        // Chuyển hướng về danh sách danh mục với thông báo
        return redirect()->route('admin.categories')->with('success', 'Danh mục đã được thêm thành công!');
    }

    // Hiển thị thông tin một danh mục
    public function show($id)
    {
        // Lấy danh mục theo ID
        $category = Category::findOrFail($id);

        $posts = $category->posts; // Lấy các bài viết thuộc danh mục

        // Trả về view categories.show với dữ liệu danh mục
        return view('admin.categories.show', compact('category', 'posts'));
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Lấy danh mục theo ID
        return view('admin.categories.edit', compact('category')); // Trả về form chỉnh sửa
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id); // Lấy danh mục theo ID

        // Validate dữ liệu form
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id, // Kiểm tra tính duy nhất
        ]);

        // Cập nhật danh mục
        $category->update([
            'name' => $request->name,
        ]);

        // Chuyển hướng về danh sách danh mục với thông báo
        return redirect()->route('admin.categories')->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    // Xóa danh mục
    public function destroy($id)
    {
        $category = Category::findOrFail($id); // Lấy danh mục theo ID

        // Xóa danh mục
        $category->delete();

        // Chuyển hướng về danh sách danh mục với thông báo
        return redirect()->route('admin.categories')->with('success', 'Danh mục đã được xóa thành công!');
    }
}