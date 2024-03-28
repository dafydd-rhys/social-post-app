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
        <script> 
            $(document).ready(function() {
                $('.comment-button').click(function() {
                    var postId = "{{ $post->id }}";
                    var userId = 51; 
                    var commentContent = $('.comment-box').val();
                    var token = "{{ csrf_token() }}";

                    $.ajax({
                        url: '/save',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        data: {
                            user_id: userId,
                            website_posts_id: postId,
                            content: commentContent
                        },
                        success: function(response) {
                        console.log(response);
                        location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
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
                    <button class="comment-button">
                        <i class = "fa-solid fa-share-alt"></i>Comment
                    </button>
                </div>

                <div class="comment-section">
                    <div class="comment-container">
                        <input type="hidden" id="currentCommentPage" value="1">
                        
                        @foreach($comments as $comment)
                            @include('comment-card', ['comment' => $comment])
                        @endforeach       
                    </div>
                </div>
            </div> 
        </a>
    </body>
</html>