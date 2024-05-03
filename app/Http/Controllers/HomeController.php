<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Container;
use App\Services\WeatherService;
use App\Models\WebsitePosts;
use App\Models\User;

class HomeController extends Controller
{
    protected $container;
    protected $weatherService;

    public function __construct(Container $container, WeatherService $weatherService)
    {
        $this->container = $container;
        $this->weatherService = $weatherService;
    }

    public function index()
    {
        $posts = WebsitePosts::take(9)->get();

        foreach ($posts as $post) {
            $post->user = User::find($post->user_id);
        }

        return view('home', ['posts' => $posts]);
    }
}
