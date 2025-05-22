@extends('layouts.admin')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Danh sách bài viết</h1>
    <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Thêm bài viết</a>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<table class="table-auto w-full bg-white shadow-md rounded">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2">STT</th>
            <th class="px-4 py-2">Tiêu đề</th>
            <th class="px-4 py-2">Tác giả</th>
            <th class="px-4 py-2">Danh mục</th>
            <th class="px-4 py-2">Thời gian</th> <!-- Thêm cột thời gian -->
            <th class="px-4 py-2">Hình ảnh</th>
            <th class="px-4 py-2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td class="border px-4 py-2">{{ $post->id }}</td>
            <td class="border px-4 py-2">{{ $post->title }}</td>
            <td class="border px-4 py-2">{{ $post->author }}</td>
            <td class="border px-4 py-2">
                {{ $post->category ? $post->category->name : 'Chưa có danh mục' }}
            </td>
            <td class="border px-4 py-2">
                {{ $post->created_at->format('d/m/Y H:i') }}
                <!-- Hiển thị thời gian tạo bài viết -->
            </td>
            <td class="border px-4 py-2">
                @if ($post->image)
                <img src="{{ asset($post->image) }}" alt="Hình ảnh bài viết" width="100">
                @else
                Không có ảnh
                @endif
            </td>

            </td>
            <td class="border px-4 py-2">
                <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-500 hover:underline">Sửa</a>
                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection