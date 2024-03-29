<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments; 
use App\Models\WebsitePosts; 

class CommentsController extends Controller
{

    public function show($commentId)
    {
        $comment = Comments::find($commentId);
        $post = WebsitePosts::find($comment->website_posts_id);
        $user = auth()->user();

        return view('edit-comments', ['comment' => $comment, 'user' => $user, 'post' => $post]);
    }

    public function store(Request $request)
    {
        Comments::create([
            'user_id' => $request->user_id,
            'website_posts_id' => $request->website_posts_id,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Comment saved successfully']);
    }

    public function destroy($id)
    {
        $comment = Comments::find($id);
        $comment -> delete();
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = Comments::find($id);
        $comment->content = $validatedData['content'];
        $comment->save();

        return response()->json(['message' => 'Comment updated successfully']);
    }
}
