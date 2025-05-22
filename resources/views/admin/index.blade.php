<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex h-screen">
        <!-- Sidebar content -->
        <div class="w-1/4 bg-gray-800 text-white min-h-screen">
            <div class="p-6 text-center">
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/03/Logo-DH-Kien-Truc-Da-Nang-DAU.png"
                        alt="Admin Logo" class="w-16 h-auto mx-auto">
                    <h1 class="text-3xl font-semibold mt-4">Admin Panel</h1>
                </a>
            </div>
            <ul class="space-y-4 p-6">
                <li><a href="{{ route('admin.index') }}"
                        class="text-lg hover:bg-gray-700 py-2 px-4 block rounded">Dashboard</a>
                </li>
                <li><a href="{{ route('admin.users') }}" class="text-lg hover:bg-gray-700 py-2 px-4 block rounded">Quản
                        lý người
                        dùng</a></li>
                <li><a href="{{ route('admin.posts.index') }}"
                        class="text-lg hover:bg-gray-700 py-2 px-4 block rounded">Quản
                        lý bài
                        viết</a></li>
                <li><a href="{{ route('admin.categories') }}"
                        class="text-lg hover:bg-gray-700 py-2 px-4 block rounded">Quản lý danh
                        mục</a></li>

            </ul>
        </div>

        <!-- Main content -->
        <div class="w-3/4 p-8 overflow-y-auto">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Admin Dashboard
                    </h2>
                    <!-- User Info and Logout Button -->
                    <div class="flex items-center space-x-4">
                        @if (Auth::check() && Auth::user()->usertype == 'admin')
                        <!-- Hiển thị tên người dùng nếu đã đăng nhập và là admin -->
                        <span class="text-gray-800 font-medium">Xin chào, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                Đăng xuất
                            </button>
                        </form>
                        @else
                        <!-- Nếu không phải admin, sẽ redirect về trang đăng nhập -->
                        <script>
                        window.location.href = "{{ route('login') }}";
                        </script>
                        @endif
                    </div>
                </div>

                <!-- Dashboard Content -->
                <div class="mt-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-bold">Total Users</h3>
                            <p class="text-lg">{{ $totalUsers }}</p> <!-- Chỉnh sửa: Hiển thị số lượng người dùng -->
                        </div>
                        <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-bold">Total Posts</h3>
                            <p class="text-lg">{{ $totalPosts }}</p> <!-- Hiển thị tổng số bài viết -->
                        </div>
                        <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-bold">Tổng danh mục</h3>
                            <p class="text-lg">{{ $totalCategories }}</p>
                        </div>

                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                        <div class="alert alert-info">

                            @if (isset($newComments) && $newComments->count() > 0)
                            <ul>
                                @foreach ($newComments as $comment)
                                <li>
                                    <strong>{{ $comment->user->name }}</strong> đã bình luận vào bài viết
                                    <a
                                        href="{{ route('post.show', $comment->post->id) }}">{{ $comment->post->title }}</a>
                                    lúc {{ $comment->created_at->format('H:i d/m/Y') }}.
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p>Không có bình luận mới.</p>
                            @endif
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

</body>

</html>