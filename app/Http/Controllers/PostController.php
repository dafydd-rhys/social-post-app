<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\WebsitePosts;
use App\Models\Comments;
use App\Models\User;
use App\Models\Tag;

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
        $post = WebsitePosts::findOrFail($postId);

        // Retrieve comments using the polymorphic relationship
        $comments = $post->comments;

        // Determine the logged-in user's role and ownership of the post
        $user = User::find($post->user_id);
        $loggedInUser = auth()->user();
        $isAdmin = $loggedInUser && $loggedInUser->role === 'admin';
        $isModerator = $loggedInUser && $loggedInUser->role === 'moderator';
        $isCreator = $loggedInUser && $loggedInUser->id === $post->user_id;

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
        $totalPosts = WebsitePosts::count();

        if ($page < 1) {
            $page = 1; // Set to first page if negative page number is requested
        }

        if ($page > ceil($totalPosts / $perPage)) {
            $page = ceil($totalPosts / $perPage);
        }

        $offset = ($page - 1) * $perPage;
        $posts = WebsitePosts::skip($offset)->take($perPage)->get();

        return view('post-card', [
            'posts' => $posts,
            'totalPosts' => $totalPosts,
            'page' => $page,
        ]);
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
            'title' => 'required|string|max:300',
            'content' => 'required|string|max:1000',
            'tag' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $post = WebsitePosts::find($id);
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
    
        $tag = Tag::firstOrCreate(['name' => $validatedData['tag']]);
        $post->tags()->sync([$tag->id]);
    
        if ($request->hasFile('image')) {
            // Upload a new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/posts'), $imageName);
            $imagePath = 'images/posts/' . $imageName;
    
            if ($post->image_path) {
                Storage::delete('public/' . $post->image_path);
            }
            $post->image_path = $imagePath;
        } elseif ($request->has('remove_image') && $request->remove_image === 'true') {
            // Remove the existing image
            if ($post->image_path) {
                Storage::delete('public/' . $post->image_path);
                $post->image_path = '';
            }
        }
    
        $post->save();
    
        return response()->json(['message' => 'Post updated successfully'], 200);
    }
    
    

    public function create()
    {
        $user = auth()->user();

        return view('create-post', ['user' => $user]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:300',
            'content' => 'required|string|max:1000',
            'tag' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $imagePath = "";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/posts'), $imageName);
            $imagePath = 'images/posts/' . $imageName;
        }
    
        $post = new WebsitePosts();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->image_path = $imagePath;
        $post->user_id = auth()->user()->id;
    
        try {
            $post->save();
    
            if ($validatedData['tag'] !== 'None') {
                $tag = Tag::firstOrCreate(['name' => $validatedData['tag']]);
                $post->tags()->attach($tag->id);
            }
    
            return response()->json(['message' => 'Post created successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create post. ' . $e->getMessage()], 500);
        }
    }
    
}
