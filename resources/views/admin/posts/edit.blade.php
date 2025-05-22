@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Chỉnh sửa bài viết</h1>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="title" class="block text-gray-700">Tiêu đề</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-4">
        <label for="content" class="block text-gray-700">Nội dung</label>
        <textarea name="content" id="content" class="w-full p-2 border rounded">{{ $post->content }}</textarea>

    </div>

    <div class="mb-4">
        <label for="author" class="block text-gray-700">Tác giả</label>
        <input type="text" name="author" id="author" value="{{ $post->author }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-4">
        <label for="image" class="block text-gray-700">Hình ảnh</label>
        <input type="file" name="image" id="image" class="w-full p-2 border rounded">
    </div>
    <div class="mb-4">
        <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
        <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-2 border rounded" required>
            <option value="">Chọn danh mục</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
        <a href="{{ route('admin.posts') }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
            Quay lại
        </a>
</form>



@push('scripts')



@endpush

@endsection