<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <script src="https://kit.fontawesome.com/84b3df78f4.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" type="text/css" href="{{ asset('css/post-card.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
      <script src="js/pagination.js"></script>
      <script src="js/weather.js"></script>
      <script src="{{ asset('js/quote.js') }}"></script>
      <script>
         $(document).ready(function() {
             $('#searchInput').on('keyup', function() {
                 var searchText = $(this).val().toLowerCase();
                 $('.post-container .card').each(function() {
                     var title = $(this).find('.post-title').text().toLowerCase();
                     var content = $(this).find('.post-content').text().toLowerCase();
                     if (title.indexOf(searchText) === -1 && content.indexOf(searchText) === -1) {
                         $(this).hide();
                     } else {
                         $(this).show();
                     }
                 });
             });        
         });
      </script>
   </head>
   <body>
      <div id="quoteOverlay" class="overlay" style="display: none;">
         <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">X</span>
            <h2>Inspirational Quote</h2>
            <p id="quote">Loading...</p>
         </div>
      </div>
      <header class="main">
         <a href="{{ url('/') }}" class="app-container">
            <div>
               <img src="{{ asset('images/logo.png') }}" alt="Social App Logo" class="logo-image">
            </div>
            <div class="logo">SOCIAL-POST-APP</div>
         </a>
         <div class="weather-container">
            <div id="weather">
               <div class="weather-info">
                  <div class="location"></div>
                  <div class="weather-details">
                     <img src="" alt="Weather Icon" class="weather-icon">
                     <div class="temp-description">
                        <div class="temperature"></div>
                        <div class="description"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
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
      <input type="hidden" id="currentPage" value="1">
      <div class="posts">
         <div class="post-container">
            @foreach($posts as $post)
            <div class="card">
               <a href="/user/{{ $post->user->id }}" class="card-link">
                  <div class="card-content">
                     <p class="user">u/{{ $post->user->name }} • {{ $post->created_at }}</p>
                     <h2>
               <a href="{{ route('post.show', ['postId' => $post->id]) }}" class="post-title">{{ $post->title }}</a></h2>
               <p><a href="{{ route('post.show', ['postId' => $post->id]) }}" class="post-content">{{ $post->content }}</a></p>
               @if($post->tags->isNotEmpty())
               <?php
                  $tagNames = $post->tags->pluck('name')->implode(', ');
                  $imageStatus = ($post->image_path === '') ? 'No Image' : 'Image Attached';
                  ?>
               <p><a href="{{ route('post.show', ['postId' => $post->id]) }}" class="tag-photo {{ ($imageStatus === 'Image Attached') ? 'image-attached' : '' }}">{{ $tagNames }} • {{ $imageStatus }}</a></p>
               @else
               <p><a href="{{ route('post.show', ['postId' => $post->id]) }}" class="tag-photo">None • {{ ($post->image_path === '') ? 'No Image' : 'Image Attached' }}</a></p>
               @endif
               </div>
               </a>
            </div>
            @endforeach    
         </div>
         <div class="pagination">
            <button class="page-button" onclick="prevPage()">
            <i class="fa-solid fa-arrow-left"></i>  
            </button>
            <text class="page-count" id="pageCount">1</text>
            <button class="page-button" onclick="nextPage()">
            <i class="fa-solid fa-arrow-right"></i>  
            </button>
         </div>
      </div>
   </body>
</html>