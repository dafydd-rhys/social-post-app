<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments; 

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        Comments::create([
            'user_id' => $request->user_id,
            'website_posts_id' => $request->website_posts_id,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Comment saved successfully']);
    }
}
