<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function save(Request $request)
    {

        $validate = $request->validate([
            'image_id' => ['integer', 'required'],
            'content' => ['string', 'required'],
        ]);

        $user = Auth::user();
        $image_id = $request->image_id;
        $content = $request->input("content");


        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        return Redirect::route('image.detail', ['id' => $image_id])->with('status', 'comment-created');

    }

    public function delete($id)
    {
        $user = Auth::user();

        $comment = Comment::find($id);

        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            return Redirect::route('image.detail', ['id' => $comment->image->id])->with('status', 'comment-deleted');
        } else {
            return Redirect::route('image.detail', ['id' => $comment->image->id])->with('status', 'comment-not-deleted');
        }
    }
}
