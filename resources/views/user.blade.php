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
        <a href="{{ Auth::check() ? url('/user/' . Auth::id()) : url('/profile') }}">Profile</a>
        <a href="{{ url('/profile') }}">Account Management</a>
    </nav>
</header>

<div class="user-profile">
    <div class="user-content">

        <img src="{{ asset('images/profile.png') }}" alt="Profile Picture" class="profile-pic">
        <p class="username-content">{{ $user->name }}</p>
        <p class="role-content">{{ $user->role }}</p>

        <nav class="profile-nav">
            <a href="{{ url('/user/' . $user->id) }}"><text class="a">Overview</text></a>
            <a href="{{ url('/user/' . $user->id) }}/posts">Posts</a>
            <a href="{{ url('/user/' . $user->id) }}/comments">Comments</a>
        </nav>
    </div>
    <div class="user-activity">
        @foreach($comments as $comment)
            @include('comment-card', ['comment' => $comment])
        @endforeach 
        
        @foreach($posts as $post)
            @include('user-post-card', ['post' => $post])
        @endforeach 
    </div>
</div>

</body>
</html>
