<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsitePosts;

class PostController extends Controller
{
    /**
     * Show the post with the given ID.
     *
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $post = WebsitePosts::find($postId);

        if (!$post) {
            abort(404);
        }

        return view('post', ['post' => $post]);
    }
}
