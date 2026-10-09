<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'name' => 'required|max:100',
            'body' => 'required'
        ]);

        Comment::create([
            'post_id' => $postId,
            'name' => $request->name,
            'body' => $request->body
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
