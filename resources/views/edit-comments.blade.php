<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/edit.css') }}">
    <script src="{{ asset('js/update.js') }}"></script>
</head>

<body>
<header class="main">
    <a href="{{ url('/') }}" class="app-container">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Social App Logo" class="logo-image">
        </div>
        <div class="logo">SOCIAL-POST-APP</div>
    </a>

    <div class="box">
        <input type="text" id="searchInput" placeholder="Search...">
        <a href="#">
            <i class="fas fa-search"></i>
        </a>
    </div>

    <nav class="navbar">
        <a href="{{ Auth::check() ? url('/user/' . Auth::id()) : url('/profile') }}">Profile</a>
        <a href="{{ url('/profile') }}">Account Management</a>
    </nav>
</header>

<a>
    <div class="post">
        <div class="comment">
            <p class="user">Comment as {{ $user->name }}</p>

            <textarea cols="30" rows="10" class="comment-box">{{ $comment->content }}</textarea>
            
                <button class="comment-button" onclick="updateComment({{ $comment->id }}, {{ $post->id }})">
                    <i class="fa-solid fa-share-alt"></i>  
                    Update Comment
                </button>
           
        </div>
    </div>
</a>

</body>
</html>
