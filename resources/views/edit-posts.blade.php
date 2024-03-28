<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/post.css') }}">
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
            <div class="top-button-container">
                <a href="{{ url('/') }}"  class="back">
                    <button class="back-button" onclick = "back()">
                        <i class="fa-solid fa-arrow-left" > </i>  
                        Back
                    </button>
                </a>          
            </div>

                <div class="card-content">
                    <textarea cols="30" rows="10" class="post-title-box">{{ $post->title }}</textarea>
                    <textarea cols="30" rows="10" class="post-comment-box">{{ $post->content }}</textarea>
                </div>
            </div>
    </a>

</body>
</html>
