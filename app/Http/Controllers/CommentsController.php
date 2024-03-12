<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Review;


class CommentsController extends Controller
{
    public function store(Request $request, $reviewId)
    {
        $request->validate([
            'body' => 'required',
        ]);
    
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id();
        $comment->review_id = $reviewId;
        $comment->parent_id = $request->input('parent_id', null); 
        $comment->save();
    
        return back()->with('success', 'Comment added successfully.');
    }
    

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('reviews.show', $comment->review_id)->with('success', 'Comment updated successfully.');
    }

    
}
