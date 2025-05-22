<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($category)
        {{ $category->name }} - {{ config('app.name', 'IT NEWS') }}
        @else
        {{ config('app.name', 'Laravel') }}
        @endisset
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->


    <style>
    .navbar {
        background-color: #343a40;
        padding: 1rem;
    }

    .navbar-brand img {
        width: 30px;
        height: 30px;
    }

    .navbar-nav .nav-item .nav-link {
        color: #ffffff;
        padding: 10px 15px;
        font-weight: 500;
    }

    .navbar-nav .nav-item .nav-link:hover {
        color: #ff0077;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .navbar-nav .nav-item {
            margin-bottom: 10px;
        }
    }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Navbar with Logo and User Authentication Links -->
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Đăng ký</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                </li>
                @endif
                @if (Auth::check() && Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Quản trị viên</a>
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

    <!-- Nội dung chính -->

    <body>
        @yield('content')
        <!-- Nội dung trang sẽ được hiển thị ở đây -->
    </body>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>