<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/comment-card.css') }}">
    </head>
    
    <body>
        <a class="card-link">
            <div class="comment-card">
                <div class="comment-content">
                    <a href="/user/{{ $comment->user->id }}" class="comment-user">
                        u/{{ $comment->user->name }} • {{ $comment->created_at }}
                    </a>
                    <p class="comment-content">{{ $comment->content }}</p>
                </div>
            </div>
        </a>
    </body>
</html>