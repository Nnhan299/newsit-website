<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Storage;

Route::get('/images/posts/{filename}', function ($filename) {
    $path = storage_path('app/public/posts/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return response($file, 200)->header("Content-Type", $type);
});


Route::post('summernote/upload', [UploadController::class, 'upload'])->name('summernote.upload');



Route::get('/', [HomeController::class, 'index'])->name('welcome');


Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('image.upload');

// Route liên quan đến Category
Route::get('categories/{cagetories}', [CategoryController::class, 'show'])->name('categories.show');

// Route liên quan đến Post
Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show');
// web.php (Routes)

Route::get('/user/{id}/posts', [UserController::class, 'showPosts'])->name('user.posts');


// Route bảo mật (Jetstream, Sanctum)

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


// Route cho Admin
Route::get('/home', [AdminController::class, 'index'])->name('home');
//Route::get('/', [PostController::class, 'index'])->name('welcome'); ;

// Group route cho Admin với tiền tố 'admin'
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');


    // Route quản lý User
    Route::resource('users', AdminController::class)->parameters(['users' => 'user']);

    Route::get('/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Route quản lý Post
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');
    Route::get('/posts/index', [PostController::class, 'index'])->name('admin.posts.index'); // Đúng controller
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    

    // Route quản lý Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
});

// Route đăng xuất
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('welcome'); // Chuyển hướng về trang welcome sau khi đăng xuất
})->name('logout');
Route::post('/upload-image', function (Request $request) {
    if ($request->hasFile('file')) {
        $image = $request->file('file');
        $path = $image->store('images', 'public');
        return response()->json(['location' => asset('storage/' . $path)]);
    }
});
Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('post.comment.store');  