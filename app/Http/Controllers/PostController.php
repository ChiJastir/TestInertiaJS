<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Traits\HasJsonResponse;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    use HasJsonResponse;

    public function getPosts()
    {
        $posts = Post::query()->with('user')->get();
        return Inertia::render('PostsPage', compact('posts'));
    }

    public function addPostInDatabase(StorePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated);

        return $this->success(compact('post'));
    }

    public function deletePostFromDatabase(Request $request, Post $post)
    {
        $post->delete();
        return $this->success();
    }
}
