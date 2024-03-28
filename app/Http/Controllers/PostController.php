<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsitePosts;
use App\Models\Comments;
use App\Models\User;

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
    
        foreach ($comments as $comment) {
            $comment->user = User::find($comment->user_id);
        }
    
        $user = User::find($post->user_id);
    
        $loggedInUser = auth()->user();
        $isAdmin = $loggedInUser && $loggedInUser->role === 'admin';
        $isModerator = $loggedInUser && $loggedInUser->role === 'moderator';
        $isCreator = $loggedInUser && ($loggedInUser->id === $post->user_id);
    
        return view('post', [
            'post' => $post,
            'comments' => $comments,
            'user' => $user,
            'isAdmin' => $isAdmin,
            'isModerator' => $isModerator,
            'isCreator' => $isCreator,
            'loggedIn' => $loggedInUser
        ]);
    }
    
    public function getPage(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 9;
        $posts = WebsitePosts::skip(($page - 1) * $perPage)->take($perPage)->get();

        return view('post-card', ['posts' => $posts]);
    }   

    public function destroy($id)
    {
        $post = WebsitePosts::find($id);
        $post -> delete();
    }

    public function edit($postId)
    {
        $post = WebsitePosts::find($postId);
        $user = auth()->user();

        return view('edit-posts', ['user' => $user, 'post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string|max:300',
        ]);

        $post = WebsitePosts::find($id);
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();

        return response()->json(['message' => 'Post updated successfully'], 200);
    }

}
