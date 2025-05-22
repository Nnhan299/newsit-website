@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Cập nhật người dùng</h1>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST" class="bg-white p-4 shadow-md rounded">
    @csrf
    <div class="mb-4">
        <label for="name" class="block font-bold">Tên:</label>
        <input type="text" id="name" name="name" class="border w-full p-2" value="{{ old('name') }}">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="block font-bold">Email:</label>
        <input type="email" id="email" name="email" class="border w-full p-2" value="{{ old('email') }}">
        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="block font-bold">Mật khẩu:</label>
        <input type="password" id="password" name="password" class="border w-full p-2">
        @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="block font-bold">Xác nhận mật khẩu:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="border w-full p-2">
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
    <a href="{{ route('admin.users') }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Quay lại
    </a>@extends('layouts.admin')

    @section('content')
    <h1 class="text-2xl font-bold mb-4">Chỉnh sửa người dùng</h1>

    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Họ tên</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700">Vai trò</label>
            <select name="role" id="role" class="w-full p-2 border rounded" required>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Người dùng</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Quản trị viên</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
        <a href="{{ route('admin.users') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Hủy</a>
    </form>
    @endsection

</form>
@endsection