@extends('layouts.app')

@section('content')
<style>
.comments {
    margin: 2rem auto;
    /* Tự động căn giữa */
    padding: 1rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 1000px;
    /* Đặt chiều rộng tối đa */
    text-align: left;
    /* Canh trái nội dung */
}

.comments h2 {
    font-size: 1.75rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 1.5rem;
    text-align: center;
    /* Tiêu đề căn giữa */
}

.comments form {
    margin-bottom: 1.5rem;
}

.comments textarea {
    width: 100%;
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    resize: none;
    transition: all 0.3s ease;
}

.comments textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
}

.comments button {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 0.5rem 1.5rem;
    font-size: 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.comments button:hover {
    background-color: #0056b3;
}

.comments .border-b {
    padding-bottom: 1rem;
    margin-bottom: 1rem;
    border-bottom: 1px solid #ddd;
}

.comments p {
    margin: 0.5rem 0;
    font-size: 1rem;
    color: #333;
}

.comments p strong {
    font-weight: bold;
    color: #000;
}

.comments a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.comments a:hover {
    text-decoration: underline;
}
</style>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

    @if ($post->image)
    <div>

        <div class="image-gallery">
            <img src="{{ asset($post->image) }}" alt="Post image" style="height:100%; width:100%">

        </div>
        <p>Hình ảnh bài viết</p>
    </div>
    @endif

    <p class="text-gray-700 mb-6">{{ $post->content }}</p>
    <p><strong>Posted on:</strong> {{ $post->created_at->format('d/m/Y H:i') }}</p> <!-- Hiển thị thời gian đăng -->
    <div class="author">
        <p><strong>Author:</strong> {{ $post->author }}</p> <!-- Hiển thị tên tác giả -->
    </div>



    <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline">Quay lại</a>
</div>
<div class="comments mt-6">
    <h2 class="text-2xl font-bold mb-4">Bình luận</h2>

    <!-- Form thêm bình luận -->
    @auth
    <form action="{{ route('post.comment.store', $post->id) }}" method="POST" class="mb-4">
        @csrf
        <textarea name="content" rows="3" class="w-full border p-2 rounded" placeholder="Viết bình luận của bạn..."
            required></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Gửi</button>
    </form>
    @endauth

    @guest
    <p>Bạn cần <a href="{{ route('login') }}" class="text-blue-500">đăng nhập</a> để bình luận.</p>
    @endguest

    <!-- Danh sách bình luận -->
    @foreach ($post->comments as $comment)
    <div class="border-b border-gray-300 mb-4 pb-2">
        <p><strong>{{ $comment->user->name }}</strong> - {{ $comment->created_at->format('d/m/Y H:i') }}</p>
        <p>{{ $comment->content }}</p>
    </div>
    @endforeach
</div>

@endsection