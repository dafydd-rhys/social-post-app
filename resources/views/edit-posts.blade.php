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
      <script src="{{ asset('js/upload.js') }}"></script>
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
      <a href="{{ route('post.show', ['postId' => $post->id]) }}"  class="back">
      <button class="back-button" onclick = "back()">
      <i class="fa-solid fa-arrow-left" > </i>  
      Back
      </button>
      </a>          
      </div>
      <div class="card-content">
      <textarea cols="30" rows="10" class="post-title-box">{{ $post->title }}</textarea>
      <p class="title-info"> / 300</p>
      <input type="file" id="imageUpload" style="display: none;">
      <div class="upload">
      <button class="upload-button" onclick="document.getElementById('imageUpload').click()">
      Upload Image
      </button>
      <span class="upload-name" id="imageName">{{ $post->image_path }}</span>
      @if (!empty($post->image_path))
      <button id="removeImageBtn" class="remove-image-button">X</button>
      @endif
      </div>
      <textarea cols="30" rows="10" class="post-comment-box">{{ $post->content }}</textarea>
      <p class="description-info"> / 1000</p>
      <div class="tag">
      <select id="tag-select" multiple>
      <option value="None">Select Tag</option>
      <option value="Technology">Technology</option>
      <option value="Travel">Travel</option>
      <option value="Food">Food</option>
      <option value="Health & Wellness">Health & Wellness</option>
      <option value="Fashion">Fashion</option>
      <option value="Sports">Sports</option>
      <option value="Music">Music</option>
      <option value="Art & Design">Art & Design</option>
      <option value="Books & Literature">Books & Literature</option>
      <option value="Movies & TV Shows">Movies & TV Shows</option>
      <option value="Education">Education</option>
      <option value="Politics">Politics</option>
      <option value="Business & Finance">Business & Finance</option>
      <option value="Science & Nature">Science & Nature</option>
      <option value="History">History</option>
      <option value="Lifestyle">Lifestyle</option>
      </select>
      </div>
      <button class="post-update-button" onclick="updatePost({{ $post->id }})" >
      Update Post
      </button>
      </div>
      </div>
      </a>
      <script>
         document.addEventListener('DOMContentLoaded', function() {
             var currentTag = "{{ $post->tags->isNotEmpty() ? $post->tags->first()->name : 'None' }}";
             var tagSelect = document.getElementById('tag-select');
         
             for (var i = 0; i < tagSelect.options.length; i++) {
                 if (tagSelect.options[i].value === currentTag) {
                     tagSelect.options[i].selected = true;
                     break;
                 }
             }
         });
      </script>
   </body>
</html>