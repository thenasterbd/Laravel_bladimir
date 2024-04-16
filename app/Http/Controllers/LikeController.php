<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);

        return view('likes.index', [
            'likes' => $likes
        ]);
    }

    public function like($image_id)
    {
        $user = Auth::user();

        //IF LIKE EXIST
        $isser_like = Like::where("user_id", $user->id)->where("image_id", $image_id)->count();

        if ($isser_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int) $image_id;

            $like->save();

            return response()->json([
                "like" => $like,
                'count' => count($like->image->likes),
                'status' => 'like',
            ]);
        } else {
            return response()->json([
                'status' => 'like-exist',
                'error' => $isser_like
            ]);
        }
    }

    public function undo_like($image_id)
    {
        $user = Auth::user();

        $like = Like::where("user_id", $user->id)->where("image_id", $image_id)->first();

        if ($like) {

            $like->delete();

            return response()->json([
                "like" => $like,
                'count' => count($like->image->likes),
                'status' => 'undo_like'
            ]);
        } else {
            return response()->json([
                'status' => 'undo_like-exist'
            ]);
        }
    }

    public function toggle_like($image_id)
    {
        $user = Auth::user();

        $like = Like::where("user_id", $user->id)->where("image_id", $image_id)->first();
        $dislike = Dislike::where("user_id", $user->id)->where("image_id", $image_id)->first();

        if ($like) {
            $like->delete();

            return response()->json([
                "like" => $like,
                'count' => count($like->image->likes),
                'status' => 'undo_like'
            ]);
        } else {

            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int) $image_id;
            $like->save();

            // Check if user has already liked the image
            if ($dislike) {
                $dislike->delete(); // Remove the existing like

                return response()->json([
                    "dislike" => $dislike,
                    "like" => $like,
                    'count' => count($like->image->likes),
                    'count_dislikes' => count($dislike->image->dislikes),
                    'status' => 'like-undo_dislike'
                ]);
            }

            return response()->json([
                "like" => $like,
                'count' => count($like->image->likes),
                'status' => 'like'
            ]);
        }
    }
}