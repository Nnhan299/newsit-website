<?php

namespace App\Livewire;

use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    // Định nghĩa các quy tắc xác thực
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|same:password_confirmation',
    ];

    // Xử lý đăng ký
    public function register()
    {
        $this->validate();

        // Tạo người dùng mới
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Thông báo và chuyển hướng
        session()->flash('message', 'Đăng ký thành công!');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.register');
    }
}