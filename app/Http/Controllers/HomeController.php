<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsitePosts;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $posts = WebsitePosts::take(9)->get();

        foreach ($posts as $post) {
            $post->user = User::find($post->user_id);
        }

        return view('home', ['posts' => $posts]);
    }
}
