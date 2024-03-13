<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/post/{id?}', function ($post_id) {
    return view('post');
});

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