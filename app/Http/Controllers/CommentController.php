<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{



    public function index()
    {
        //

    }

    public function create() { /* ... */ }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
            'content' => 'required|string',
        ]);

        Comment::create([
            'post_id' => $validated['post_id'],
            'parent_id' => $validated['parent_id'],
            'commenter_name' => Auth::user()->name,
            'content' => $validated['content'],
        ]);

        return redirect()->route('posts.show', $validated['post_id'])
            ->with('success', 'Comment added successfully!');
    }

    public function show(Comment $comment) { /* ... */ }

    public function edit(Comment $comment) { /* ... */ }
    public function update(Request $request, Comment $comment) { /* ... */ }
    public function destroy(Comment $comment) { /* ... */ }
}
