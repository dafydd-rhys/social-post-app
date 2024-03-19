<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsitePosts;
use App\Models\Comments;

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
        $comments = Comments::where('website_posts_id', $postId)->get();
    
        if (!$post) {
            abort(404);
        }
    
        return view('post', ['post' => $post, 'comments' => $comments]);
    }

}
