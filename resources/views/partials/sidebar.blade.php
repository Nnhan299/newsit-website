<div class="p-6 text-center">
    <a href="{{ route('welcome') }}">
        <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/03/Logo-DH-Kien-Truc-Da-Nang-DAU.png"
            alt="Admin Logo" class="w-16 h-auto mx-auto">
        <h1 class="text-3xl font-semibold mt-4">Admin Panel</h1>
    </a>
</div>
<ul class="space-y-4 p-6">
    <li><a href="{{ route('admin.index') }}" class="text-lg hover:bg-gray-700 py-2 px-4 block rounded">Dashboard</a>
    </li>
    <li><a href="{{ route('admin.users') }}" class="text-lg hover:bg-gray-700 py-2 px-4 block rounded">Quản lý người
            dùng</a></li>
    <li><a href="{{ route('admin.posts.index') }}" class="text-lg hover:bg-gray-700 py-2 px-4 block rounded">Quản lý bài
            viết</a></li>
    <li><a href="{{ route('admin.categories') }}" class="text-lg hover:bg-gray-700 py-2 px-4 block rounded">Quản lý danh
            mục</a></li>

</ul>