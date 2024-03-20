<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/comment-card.css') }}">
    </head>
    
    <body>
        <a href="" class="card-link">
            <div class="comment-card">
                <div class="comment-content">
                    <p class="comment-user">u/Str • {{ $comment->created_at }}</p>
                    <p class="comment-content">{{ $comment->content }}</p>
                </div>
            </div>
        </a>

    </body>
</html>