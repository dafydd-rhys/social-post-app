<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsitePosts;

class HomeController extends Controller
{
    public function index()
    {
        $posts = WebsitePosts::take(12)->get();

        return view('home', ['posts' => $posts]);
    }
}
