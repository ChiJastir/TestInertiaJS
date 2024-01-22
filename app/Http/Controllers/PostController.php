<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function getPosts()
    {
        $posts = Post::query()->with('user')->get();
        return Inertia::render('PostsPage', compact('posts'));
    }

    public function addPostInDatabase(StorePostRequest $request)
    {
        $validated = $request->validated();
        Post::create($validated);
    }

    public function deletePostFromDatabase(Request $request, Post $post)
    {
        $post->delete();
    }
}
