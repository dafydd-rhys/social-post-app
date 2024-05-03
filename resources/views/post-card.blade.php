<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/post-card.css') }}">
   </head>
   <body>
      <input type="hidden" id="currentPage" value="{{ $page }}">
      @foreach($posts as $post)
      <div class="card">
         <a href="/user/{{ $post->user->id }}" class="card-link">
            <div class="card-content">
               <p class="user">u/{{ $post->user->name }} • {{ $post->created_at }}</p>
               <h2>
         <a href="{{ route('post.show', ['postId' => $post->id]) }}" class="post-title">{{ $post->title }}</a></h2>
         <p><a href="{{ route('post.show', ['postId' => $post->id]) }}" class="post-content">{{ $post->content }}</a></p>
         @if($post->tags->isNotEmpty())
         <?php
            $tagNames = $post->tags->pluck('name')->implode(', ');
            $imageStatus = ($post->image_path === '') ? 'No Image' : 'Image Attached';
            ?>
         <p><a href="{{ route('post.show', ['postId' => $post->id]) }}" class="tag-photo {{ ($imageStatus === 'Image Attached') ? 'image-attached' : '' }}">{{ $tagNames }} • {{ $imageStatus }}</a></p>
         @else
         <p><a href="{{ route('post.show', ['postId' => $post->id]) }}" class="tag-photo">None • {{ ($post->image_path === '') ? 'No Image' : 'Image Attached' }}</a></p>
         @endif
         </div>
         </a>
      </div>
      @endforeach  
   </body>
</html>