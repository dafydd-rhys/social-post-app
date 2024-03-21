<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/post/{postId}', [PostController::class, 'show'])->name('post.show');

Route::post('/save', [CommentsController::class, 'store']);

Route::get('/nextPage', [PostController::class, 'getPage']);

Route::get('/prevPage', [PostController::class, 'getPage']);

Route::get('/user/{user_id?}', function ($user_id) {
    return view('user');
});

Route::get('/user/{user_id}/comments/{comment_id}', function ($user_id, $comment_id) {
    return view('comment');
});

Route::get('/login', function ($user_id) {
    return view('login');
});

Route::get('/register', function ($user_id) {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
