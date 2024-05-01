<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/comment', function () {
    return view('user-post-card');
});

Route::post('/update-comment/{id}', [CommentsController::class, 'update']);

Route::post('/update-post/{id}', [PostController::class, 'update']);

Route::post('/send-email', [EmailController::class, 'sendEmail']);

Route::get('/comment/{commentId}/edit', [CommentsController::class, 'show']);

Route::get('/post/{postId}', [PostController::class, 'show'])->name('post.show');

Route::get('/post/{postId}/edit', [PostController::class, 'edit']);

Route::get('/create-post', [PostController::class, 'create']);

Route::post('/create-post', [PostController::class, 'store'])->name('post.store');

Route::delete('/post/{id}', [PostController::class, 'destroy']);

Route::delete('/comment/{id}', [CommentsController::class, 'destroy']);

Route::post('/save', [CommentsController::class, 'store']);

Route::get('/nextPage', [PostController::class, 'getPage']);

Route::get('/prevPage', [PostController::class, 'getPage']);

Route::get('/user/{user_id}', [UserController::class, 'show'])->name('user');

Route::get('/user/{user_id}/posts', [UserController::class, 'posts'])->name('user');

Route::get('/user/{user_id}/comments', [UserController::class, 'comments'])->name('user');

Route::get('/user/{user_id}/profile-comments', [UserController::class, 'profileComments'])->name('user');

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
