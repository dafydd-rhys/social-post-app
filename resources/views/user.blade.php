<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
    <script src="https://kit.fontawesome.com/84b3df78f4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header class="main">
    <a href="{{ url('/') }}" class="app-container">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Social App Logo" class="logo-image">
        </div>
        <div class="logo">SOCIAL-POST-APP</div>
    </a>

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

<div class="user-profile">
    <div class="user-content">

        <img src="{{ asset('images/profile.png') }}" alt="Profile Picture" class="profile-pic">
        <p class="username-content">{{ $user->name }}</p>
        <p class="role-content">{{ $user->role }}</p>

        <nav class="profile-nav">
            <a class = "nav-overview" href="{{ url('/user/' . $user->id) }}">Overview</a>
            <a class = "nav-posts" href="{{ url('/user/' . $user->id) }}/posts">Posts</a>
            <a class = "nav-comments" href="{{ url('/user/' . $user->id) }}/comments">Post Comments</a>
            <a class = "nav-profile-comments" href="{{ url('/user/' . $user->id) }}/profile-comments">Profile Comments</a>
        </nav>
    </div>
    <div class="user-activity">
    @php
                            $loggedInUser = auth()->user();
                            $isAdmin = $loggedInUser && $loggedInUser->role === 'admin';
                            $isModerator = $loggedInUser && $loggedInUser->role === 'moderator';
                        @endphp

                        @foreach($comments as $comment)
                        @php
                            $isCreator = $loggedInUser && $loggedInUser->id === $comment->user_id;
                        @endphp
                        @include('comment-card', [
                            'comment' => $comment,
                            'isAdmin' => $isAdmin,
                            'isModerator' => $isModerator,
                            'isCreator' => $isCreator
                        ])
                        @endforeach  
        
        @foreach($posts as $post)
            @include('user-post-card', ['post' => $post])
        @endforeach 
    </div>
</div>
<script>
    $(document).ready(function() {
        // Get the current URL
        var currentUrl = window.location.href;
        
        if (currentUrl.endsWith("/posts")) {
            $('.nav-posts').css('background-color', 'orangered');
        } else if (currentUrl.endsWith("/comments")) {
            $('.nav-comments').css('background-color', 'orangered');
        } else if (currentUrl.endsWith("/profile-comments")) {
            $('.nav-profile-comments').css('background-color', 'orangered');
        } else {
            $('.nav-overview').css('background-color', 'orangered');
        }
    });
</script>
</body>
</html>
