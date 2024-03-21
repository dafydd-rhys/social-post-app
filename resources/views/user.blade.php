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
    <a href="{{ url('/') }}" class="logo">SOCIAL-POST-APP</a>

    <nav class="navbar">
        <a href="{{ url('/dashboard') }}">Account</a>
    </nav>
</header>

<div class="user-profile">
    <div class="user-content">

        <img src="{{ asset('images/profile.png') }}" alt="Profile Picture" class="profile-pic">
        <p class="username-content">{{ $user->name }}</p>
        <p class="role-content">{{ $user->role }}</p>

        <nav class="profile-nav">
            <a href="{{ url('/') }}"><text class="a">Overview</text></a>
            <a href="{{ url('/') }}">Posts</a>
            <a href="{{ url('/') }}">Comments</a>
        </nav>
    </div>
    <div class="user-activity">
        
    </div>
</div>

</body>
</html>
