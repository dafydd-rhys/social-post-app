<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/post-card.css') }}">
        <script src="https://kit.fontawesome.com/84b3df78f4.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js/pagination.js"></script>
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
        <input type="hidden" id="currentPage" value="1">

        <div class="posts">
            <div class="post-container">
    
                @foreach($posts as $post)
                <a href="{{ route('post.show', ['postId' => $post->id]) }}" class="card-link">
                    <div class="card">
                        <div class="card-content">
                            <p class="user">u/Stry • 3 hr. ago</p>
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <p class="post-content">{{ $post->content }}</p>
                        </div>
                    </div>
                </a>
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
