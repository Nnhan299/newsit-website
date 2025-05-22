<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng
        $request->session()->invalidate(); // Xóa session
        $request->session()->regenerateToken(); // Tạo lại token CSRF

        return redirect('/welcome'); // Chuyển hướng về trang chủ
    }
}