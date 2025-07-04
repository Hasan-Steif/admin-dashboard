<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|string|max:1000',
            'author_name' => 'nullable|string|max:100',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->body = $data['body'];

        if (auth()->check()) {
            $comment->user_id = auth()->id();
        } else {
            $comment->author_name = $data['author_name'];
        }

        $comment->save();

        return back()->with('success', 'Comment added successfully!');
    }
}
