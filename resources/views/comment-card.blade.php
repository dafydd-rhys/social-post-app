<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/comment-card.css') }}">
      <script src="{{ asset('js/post.js') }}"></script>
   </head>
   <body>
      <a class="card-link">
         <div class="comment-card">
            <div class="comment-content">
               <div class="top-info-container">
      <a href="/user/{{ $comment->user->id }}" class="comment-user">
      u/{{ $comment->user->name }} • {{ $comment->created_at }}
      </a>
      <div class="dropdown-c">
      <button class="modify-button">
      <i class="fa-solid fa-sliders"></i>
      </button>   
      <div class="dropdown-content-c">
      <a href="#" class="visit-option" onclick = "visit('{{ $comment->commentable_type }}', '{{ $comment->commentable_id }}')">Visit</a>
      @if ($isAdmin || $isModerator || $isCreator)   
      <a href="javascript:void(0)" class="delete-option" onclick="deleteComment({{ $comment->id }})">Delete</a>
      @endif
      @if ($isCreator)
      <a href="/comment/{{ $comment->id }}/edit" class="edit-option">Edit</a>
      @endif 
      </div>
      </div>
      </div>
      <p class="comment-content">{{ $comment->content }}</p>
      </div>
      </div>
      </a>
   </body>
</html>