<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comments;
use App\Models\WebsitePosts;

class UserController extends Controller
{
    public function show($userId)
    {
        $loggedInUser = auth()->user();
        $user = User::find($userId);
        if (!$user) {
            abort(404);
        }

        $comments = Comments::where('commentable_id', $userId)
                            ->where('commentable_type', User::class)
                            ->get();

        $posts = [];

        return view('user', ['user' => $user, 'posts' => $posts, 'comments' => $comments, 'loggedIn' => $loggedInUser]);
    }

    public function posts($userId)
    {
        $loggedInUser = auth()->user();
        $user = User::find($userId);
        $posts = WebsitePosts::where('user_id', $userId)->get();     
        $comments = [];

        if (!$user) {
            abort(404);
        }
    
        return view('user', ['user' => $user, 'posts' => $posts, 'comments' => $comments, 'loggedIn' => $loggedInUser]);
    }

    public function comments($userId)
    {
        $loggedInUser = auth()->user();
        $user = User::find($userId);
        if (!$user) {
            abort(404);
        }

        $comments = Comments::where('user_id', $userId)
                            ->where('commentable_type', WebsitePosts::class)
                            ->get();

        $posts = [];

        return view('user', ['user' => $user, 'posts' => $posts, 'comments' => $comments, 'loggedIn' => $loggedInUser]);
    }

    public function profileComments($userId)
    {
        $loggedInUser = auth()->user();
        $user = User::find($userId);
        if (!$user) {
            abort(404);
        }

        $comments = Comments::where('user_id', $userId)
                            ->where('commentable_type', User::class)
                            ->get();

        $posts = [];

        return view('user', ['user' => $user, 'posts' => $posts, 'comments' => $comments, 'loggedIn' => $loggedInUser]);
    }


}