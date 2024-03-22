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
        $user = User::find($userId);
        $comments = Comments::where('user_id', $userId)->get();
        $posts = WebsitePosts::where('user_id', $userId)->get();    

        if (!$user) {
            abort(404);
        }
    
        return view('user', ['user' => $user, 'posts' => $posts, 'comments' => $comments]);
    }
}