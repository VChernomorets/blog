<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store()
    {
        request()->validate([
           'body' => 'required'
        ]);

        $comment = new Comment;
        $comment->body = request('body');
        $comment->user_id = Auth::id();
        $comment->post_id = request('post_id');
        $comment->save();
        return redirect()->route('post.show', request('post_id'));
    }
}
