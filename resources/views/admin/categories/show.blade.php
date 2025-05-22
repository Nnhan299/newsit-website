@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh mục: {{ $category->name }}</h1>

    @if ($posts->count() > 0)
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>Không có bài viết nào trong danh mục này.</p>
    @endif
</div>
@endsection