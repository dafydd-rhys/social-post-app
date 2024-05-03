<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/edit.css') }}">
      <script src="https://kit.fontawesome.com/84b3df78f4.js" crossorigin="anonymous"></script>
      <script src="{{ asset('js/update.js') }}"></script>
   </head>
   <body id="edit-comments-blade">
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
      <a href="{{ $previous }}"  class="back">
      <button class="back-button" onclick = "back()">
      <i class="fa-solid fa-arrow-left" > </i>  
      Back
      </button>
      </a>  
      <div class="comment">
      <p class="user">Comment as {{ $user->name }}</p>
      <textarea cols="30" rows="10" class="comment-box">{{ $comment->content }}</textarea>
      <p class="info">/ 500</p>
      <button class="comment-button" onclick="updateComment({{ $comment->id }}, '{{ $previous }}')">
      Update Comment
      </button>
      </div>
      </div>
      </a>
   </body>
</html>