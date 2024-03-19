<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ asset('card.css') }}">
    </head>
    <body>
        <a href="{{ route('post.show', ['postId' => $post->id]) }}" class="card-link">
            <div class="card">
                <div class="card-content">
                    <p class="user">u/Stryzhh • 3 hr. ago</p>
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <p class="post-content">{{ $post->content }}</p>
                </div>
            </div>
        </a>
    </body>
</html>