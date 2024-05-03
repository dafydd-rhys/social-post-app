<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments; 
use App\Models\WebsitePosts; 
use App\Models\User; 
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{

    public function show($commentId) {
        $comment = Comments::find($commentId);
        if (!$comment) {
            abort(404);
        }
        $user = auth()->user();

        if ($comment->commentable_type === WebsitePosts::class) {
            $post = WebsitePosts::find($comment->commentable_id);
            $previous = url('/post/' . $post->id);
        } elseif ($comment->commentable_type ===  User::class) {
            $user = User::find($comment->commentable_id);
            $previous = url('/user/' . $user->id);
        } else {
            abort(404);
        }

        return view('edit-comments', [
            'comment' => $comment,
            'user' => $user,
            'previous' => $previous
        ]);
    }

    public function store(Request $request)
    {
        $type = $request->commentable_type === true ? WebsitePosts::class : User::class;
        $commentable = $type::find($request->commentable_id);

        if (!$commentable) {
            return response()->json(['message' => 'Commentable entity not found'], 404);
        }

        $comment = new Comments([
            'user_id' => $request->user_id,
            'content' => $request->content,
        ]);

        try {
            $commentable->comments()->save($comment);

            return response()->json(['message' => 'Comment saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create comment. ' . $e->getMessage()], 500);
        }
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
