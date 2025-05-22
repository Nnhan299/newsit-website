<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Tải Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tải Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
</head>



</html>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gray-800 text-white min-h-screen">
            @include('partials.sidebar')
            <!-- Tách sidebar nếu cần -->
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-8 overflow-y-auto">
            <div class="bg-white shadow-lg rounded-lg p-6">
                @yield('content')
                <!-- Nơi các nội dung con được hiển thị -->
            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif


    <!-- Tải jQuery trước -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tải Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Các script bổ sung -->
    @stack('scripts')

</body>



</html>