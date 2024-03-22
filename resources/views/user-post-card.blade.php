<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/user-post-card.css') }}">
    </head>
    <body>
        <a class="card-link">
            <div class="card">
                <div class="card-content">
                    <p class="user">u/{{ $post->user->name }} • {{ $post->created_at }}</p>
                    <a href="{{ route('post.show', ['postId' => $post->id]) }}" class="title-dec"><h2 class="post-title">{{ $post->title }}</h2></a>
                    <p class="post-content">{{ $post->content }}</p>
                </div>
            </div>
        </a>
    </body>
</html>