<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

use App\Models\Post;

Route::get('/', function () {
    $featured = Post::published()->latest('published_at')->first();

    $others = Post::published()
        ->with(['user', 'category'])
        ->when($featured, fn ($query) => $query->where('id', '!=', $featured->id))
        ->latest('published_at')
        ->paginate(9)
        ->withQueryString();

    return view('welcome', compact('featured', 'others'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/posts/my-posts', [PostController::class, 'myPosts'])
        ->name('posts.my_posts');

    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('posts.create');

    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');

    Route::put('/posts/{post}', [PostController::class, 'update'])
        ->name('posts.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');

    Route::post('/posts/{post}/approve', [PostController::class, 'approve'])
        ->name('posts.approve');
});

Route::resource('posts', PostController::class)
    ->only(['index', 'show']);

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])
    ->name('categories.show');

require __DIR__.'/auth.php';
