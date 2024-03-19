<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('home.css') }}">
        <script src="https://kit.fontawesome.com/84b3df78f4.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                $('.show-more').on('click', function() {
                    var currentPage = parseInt($('#currentPage').val());
                    
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

        <div class="posts">
            <div class="post-container">
                <input type="hidden" id="currentPage" value="1">

                @foreach($posts as $post)
                    @include('post-card', ['post' => $post])
                @endforeach    
            </div>

            <button class="show-more">Show More</button>
        </div>
    </body>
</html>
