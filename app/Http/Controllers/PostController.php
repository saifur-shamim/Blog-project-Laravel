<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'asc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.view_post', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

}

