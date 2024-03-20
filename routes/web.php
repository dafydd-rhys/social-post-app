<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/post/{postId}', [PostController::class, 'show'])->name('post.show');

Route::post('/save', [CommentsController::class, 'store']);

Route::get('/nextPage', [PostController::class, 'getPage']);

Route::get('/prevPage', [PostController::class, 'getPage']);

Route::get('/user/{user_id?}', function ($user_id) {
    return view('user');
});

Route::get('/user/{user_id}/comments', function ($user_id) {
    return view('user_comments');
});

Route::get('/user/{user_id}/comments/{comment_id}', function ($user_id, $comment_id) {
    return view('comment');
});

Route::get('/account/{user_id?}', function ($user_id) {
    return view('account');
});

Route::get('/login', function ($user_id) {
    return view('login');
});

Route::get('/register', function ($user_id) {
    return view('register');
});