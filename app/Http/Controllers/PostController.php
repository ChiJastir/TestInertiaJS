<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function getPosts()
    {
        $posts = Post::query()->get();

        for ($i = 0; $i < $posts->count(); $i++) {
            $posts[$i]['user'] = User::query()->find($posts[$i]['user_id']);
        }

        return Inertia::render('PostsPage', [
            'posts' => $posts
        ]);
    }

    public function addPostInDatabase(Request $request)
    {
        Post::query()->insert(
            $request->validate([
                'title' => ['required'],
                'content' => ['required'],
                'user_id' => ['required']
            ])
        );
    }

    public function deletePostFromDatabase(Request $request, Post $post)
    {
        $post->delete();
    }
}
