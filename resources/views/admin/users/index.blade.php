@extends('layouts.admin')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Quản lý người dùng</h1>
    <!-- <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Thêm người dùng</a>
-->
</div>

<table class="table-auto w-full bg-white shadow-md rounded">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Tên</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td class="border px-4 py-2">{{ $user->id }}</td>
            <td class="border px-4 py-2">{{ $user->name }}</td>
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('admin.users.edit', $user) }}"
                    class="bg-yellow-500 text-white px-2 py-1 rounded">Sửa</a>
                <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 rounded"
                        onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center py-4">Không có người dùng nào!</td>
        </tr>
        @endforelse
    </tbody>
</table>


@endsection