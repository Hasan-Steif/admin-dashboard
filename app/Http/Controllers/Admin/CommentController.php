<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'post'])->latest()->paginate(10);
        return view('admin.blog.comments.index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return view('admin.blog.comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment->update(['body' => $request->body]);

        return redirect()->route('admin.comments.index')->with('success', 'Comment updated.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted.');
    }
}
