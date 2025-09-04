<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post->load('user');

        return view('post.show', compact('post'));
    }
}
