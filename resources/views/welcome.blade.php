<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    /* Tinh chỉnh Navbar */
    .navbar {
        background-color: #343a40;
        /* Màu nền tối cho navbar */
        padding: 1rem;
        /* Khoảng cách giữa các phần tử */
    }

    .navbar-brand img {
        width: 30px;
        height: 30px;
    }

    .navbar-nav .nav-item .nav-link {
        color: #ffffff;
        /* Màu chữ trắng */
        padding: 10px 15px;
        font-weight: 500;
    }

    /* Hover Effect cho các liên kết trong Navbar */
    .navbar-nav .nav-item .nav-link:hover {
        color: #ff0077;
        /* Màu chữ khi hover */
        text-decoration: none;
        /* Bỏ gạch dưới khi hover */
    }

    /* Navbar điều chỉnh cho mobile */
    @media (max-width: 768px) {
        .navbar-nav .nav-item {
            margin-bottom: 10px;
        }
    }

    /* Card cho bài viết */
    .news-card {
        background-color: #fff;
        /* Nền trắng cho card */
        border-radius: 8px;
        /* Bo góc cho card */
        overflow: hidden;
        /* Ẩn phần vượt ra ngoài */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Tạo bóng cho card */
        margin-bottom: 20px;
        transition: transform 0.3s ease;
        /* Hiệu ứng khi hover */
    }

    .news-card:hover {
        transform: translateY(-5px);
        /* Di chuyển card lên khi hover */
    }

    /* Hình ảnh bài viết */
    .news-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        /* Đảm bảo hình ảnh không bị biến dạng */
    }

    /* Nội dung bài viết */
    .news-content {
        padding: 15px;
    }

    .news-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .news-summary {
        font-size: 1rem;
        color: #777;
    }

    /* Thanh Sidebar */
    .col-md-4 {
        background-color: #f8f9fa;
        /* Màu nền sáng cho sidebar */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề của tin tức mới nhất */
    h5 {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    /* Các liên kết trong danh sách sidebar */
    .list-group-item {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 1rem;
    }

    .list-group-item a {
        text-decoration: none;
        color: #333;
    }

    .list-group-item:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Footer */
    footer {
        background-color: #343a40;
        /* Nền tối */
        color: #fff;
        /* Màu chữ trắng */
        padding: 15px;
        text-align: center;
        margin-top: 50px;
    }

    footer a {
        color: #ff0077;
        /* Màu chữ cho liên kết */
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
        /* Gạch dưới khi hover */
    }

    /* Điều chỉnh cho màn hình nhỏ */
    @media (max-width: 768px) {
        .news-card {
            margin-bottom: 15px;
        }

        .col-md-8,
        .col-md-4 {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Đặt lại Navbar */
        .navbar-nav .nav-item {
            text-align: center;
            margin-bottom: 10px;
        }
    }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Navbar with Login/Register -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/03/Logo-DH-Kien-Truc-Da-Nang-DAU.png" alt="Logo"
                width="30" height="30"> IT NEWS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @if (Auth::check())
                <!-- Hiển thị tên người dùng nếu đã đăng nhập -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home')}}">Xin chào, {{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="border: none; background: none;">
                            Đăng xuất
                        </button>
                    </form>
                </li>
                @else
                <!-- Liên kết đến trang đăng ký -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Đăng ký</a>
                </li>
                <!-- Liên kết đến trang đăng nhập -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Navbar Chính dưới Logo -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </nav>


    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Main Articles -->
            <div class="col-md-8">
                @foreach ($posts as $post)
                <div class="news-card mb-4">
                    <!-- Ảnh bài viết -->
                    <img src="{{ asset($post->image) ?? 'https://via.placeholder.com/750x300' }}"
                        alt="{{ $post->title }}" class="news-image">

                    <!-- Nội dung bài viết -->
                    <div class="news-content mt-3">
                        <div class="news-title">
                            <a href="{{ route('post.show', $post->id) }}" class="text-dark font-weight-bold">
                                {{ $post->title }}
                            </a>
                        </div>
                        <div class="news-summary">
                            {{ Str::limit($post->summary ?? $post->content, 150) }}
                        </div>
                        <div class="text-muted mt-2">
                            Đăng ngày: {{ $post->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <h5>Tin tức mới nhất</h5>
                <ul class="list-group">
                    @foreach ($posts as $post)
                    <li class="list-group-item">
                        <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>


    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 IT News. All rights reserved. | <a href="#">Chính sách bảo mật</a></p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>