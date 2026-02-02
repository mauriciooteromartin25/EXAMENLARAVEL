<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostMOMController extends Controller
{
    
    public function index()
    {
    
        $posts = Post::with(['user', 'comments.user'])
            ->latest()
            ->paginate(10);

        return view('posts.indexMOM', compact('posts'));
    }

    
    public function show($id)
    {
        $post = Post::with(['user', 'comments.user'])
            ->findOrFail($id);

        return view('posts.show', compact('post'));
    }
}
