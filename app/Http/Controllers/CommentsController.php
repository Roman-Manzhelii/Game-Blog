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
        $request->validate(['body' => 'required',]);
    
        if ($request->parent_id) {
            $parentComment = Comment::find($request->parent_id);
            if ($parentComment->user_id == auth()->id()) {
                return back()->with('error', 'You cannot reply to your own comment.');
            }
        }
    
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id();
        $comment->review_id = $reviewId;
        $comment->parent_id = $request->parent_id ?? null;
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

    public function destroy(Request $request, $id)
    {
        $comment = Comment::find($id);

        // Check if the comment exists and if the authenticated user is allowed to delete it.
        if ($comment && auth()->id() === $comment->user_id) {
            // If the comment has replies, keep it in the database and mark it as deleted.
            if ($comment->replies()->count() > 0) {
                $comment->is_deleted = true;
                $comment->save();
            } else {
                // If no replies, then it's safe to delete the comment from the database.
                $comment->delete();
            }
            return back()->with('success', 'Comment deleted successfully.');
        }

        // If the comment does not exist or the user is not authorized to delete it, redirect back with an error message.
        return back()->with('error', 'You cannot delete this comment.');
    }
}
