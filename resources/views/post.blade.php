<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ asset('post.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('home.css') }}">
        <script src="https://kit.fontawesome.com/84b3df78f4.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <header class="main">
            <a href="#" class="logo">Logo</a>

            <div class="box">
                <input type="text" id="searchInput" placeholder="Search...">
                <a href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>

            <nav class="navbar">
                <a href="#">Home</a>
                <a href="#">Post</a>
                <a href="#">Login/Create</a>
            </nav>
        </header>

        <a>
            <div class="post">
                <a href="{{ url('/') }}"  class="back">
                    <button>
                    <i class="fa-solid fa-arrow-left"></i>  
                    Back
                </button>
                </a>

                <div class="card-content">
                    <p class="user">u/Stryzhh • 3 hr. ago</p>
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
                    <p class="user">Comment as Stryzhh</p>

                    <textarea cols="30" rows="10" class="comment-box">
                        
                    </textarea>
                    <button class="comment-button">
                        <i class = "fa-solid fa-share-alt"></i>  
                        Comment
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