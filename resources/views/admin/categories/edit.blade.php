@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-xl font-bold mb-4">Sửa danh mục</h1>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Tên danh mục</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-4 py-2"
                value="{{ $category->name }}">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
    </form>


</div>
@endsection