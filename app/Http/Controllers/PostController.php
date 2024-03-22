<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsitePosts;
use App\Models\Comments;
use App\Models\User; // Import the User model if not already imported

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
    
        // Fetch the user associated with each comment
        foreach ($comments as $comment) {
            $comment->user = User::find($comment->user_id);
        }

        // Fetch the user who created the post
        $user = User::find($post->user_id);
    
        return view('post', ['post' => $post, 'comments' => $comments, 'user' => $user]);
    }
    

    public function getPage(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 9;
        $posts = WebsitePosts::skip(($page - 1) * $perPage)->take($perPage)->get();

        return view('post-card', ['posts' => $posts]);
    }   

}
