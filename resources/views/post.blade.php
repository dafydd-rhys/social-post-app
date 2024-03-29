<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/post.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
        <script src="https://kit.fontawesome.com/84b3df78f4.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/post.js') }}"></script>
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
                    <div class="dropdown">
                        <button class="edit-button">
                            <i class="fa-solid fa-sliders"></i>
                        </button>
                        <div class="dropdown-content">
                            <a class="save-option" onclick = "save()">Save</a>
                            <a class="report-option" onclick = "report()">Report</a>
                            @if ($isAdmin || $isModerator)   
                                <a href="{{ url('/') }}" class="delete-option" onclick="deletePost({{ $post->id }})">Delete</a>
                            @endif
                            @if ($isCreator)
                                <a href="/post/{{ $post->id }}/edit" class="edit-option" onclick="editPost({{ $post->id }})">Edit</a>
                            @endif 
                        </div>
                    </div>               
                </div>

                <div class="card-content">
                    <a href="/user/{{ $post->user->id }}" class="user">
                        u/{{ $user->name }} • {{ $post->created_at }}
                    </a>
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <p class="post-content">{{ $post->content }}</p>
                </div>

                <div class="buttons">
                    <button class="comments">
                        <i class = "fa-solid fa-comment"></i>    
                        Comments   
                    </button>
                    <button class="share">
                        <i class = "fa-solid fa-share-alt"></i>  
                        Share
                    </button>
                </div>

                <div class="comment">
                    <p class="user">Comment as {{ $user->title }}</p>

                    <textarea cols="30" rows="10" class="comment-box"></textarea>
                    <button class="comment-button" onclick="comment({{ $loggedIn ? $loggedIn->id : 'null' }}, {{ $post->id }}, '{{ $user->email }}')">
                        <i class="fa-solid fa-upload"></i> Comment
                    </button>
                </div>

                <div class="comment-section">
                    <div class="comment-container">
                        <input type="hidden" id="currentCommentPage" value="1">
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
                    </div>
                </div>
            </div> 
        </a>
    </body>
</html>