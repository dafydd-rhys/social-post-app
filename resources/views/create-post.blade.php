<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/post.css') }}">
    <script src="https://kit.fontawesome.com/84b3df78f4.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/update.js') }}"></script>
</head>

<body id="edit-posts-blade">
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
                @if(Auth::check())          
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'moderator')
                        <a href="{{ url('/create-post') }}">Create Post</a>
                    @endif
                    <a href="{{ url('/user/' . Auth::id()) }}">My Profile</a>
                    <a href="{{ url('/profile') }}">Account Management</a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">@csrf</form>
                    <a href="#" onclick="event.preventDefault(); alert('You have successfully logged out.'); document.getElementById('logout-form').submit();">Logout</a>
                @else
                    <a href="{{ url('/login') }}" >Login</a>
                    <a href="{{ url('/register') }}">Create Account</a>
                @endif
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
                <p class="title">Post Title</p>
                <textarea cols="30" rows="10" class="post-title-box"></textarea>
                <p class="title-info"> / 300</p>

                <button class="upload-button" >
                    Upload Image
                </button>

                <p class="title">Post Description</p>
                <textarea cols="30" rows="10" class="post-comment-box"></textarea>
                <p class="description-info"> / 1000</p>

                <button class="post-update-button" onclick="createPost()">
                    Create Post
                </button>
            </div>
        </div>
    </a>
</body>
</html>
