<?php

namespace App\Http\Controllers;

use App\Models\Dislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class DislikeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dislikes = Dislike::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);

        return view('dislikes.index', [
            'dislikes' => $dislikes
        ]);
    }

    public function dislike($image_id)
    {
        $user = Auth::user();

        //IF DISLIKE EXIST
        $isser_dislike = Dislike::where("user_id", $user->id)->where("image_id", $image_id)->count();

        if ($isser_dislike == 0) {
            $dislike = new Dislike();
            $dislike->user_id = $user->id;
            $dislike->image_id = (int) $image_id;

            $dislike->save();

            return response()->json([
                "dislike" => $dislike,
                'count' => count($dislike->image->dislikes),
                'status' => 'undo_dislike'
            ]);
        } else {
            return response()->json([
                'status' => 'dislike-exist'
            ]);
        }


    }

    public function undo_dislike($image_id)
    {
        $user = Auth::user();

        $dislike = Dislike::where("user_id", $user->id)->where("image_id", $image_id)->first();

        if ($dislike) {

            $dislike->delete();

            return response()->json([
                "dislike" => $dislike,
                'count' => count($dislike->image->dislikes),
                'status' => 'undo_dislike'
            ]);
        } else {
            return response()->json([
                'status' => 'dislike-not-exist'
            ]);
        }
    }

    public function toggle_dislike($image_id)
    {
        $user = Auth::user();

        $dislike = Dislike::where("user_id", $user->id)->where("image_id", $image_id)->first();

        if ($dislike) {
            $dislike->delete();

            return response()->json([
                "dislike" => $dislike,
                'count' => count($dislike->image->dislikes),
                'status' => 'undo_dislike'
            ]);
        } else {
            $dislike = new dislike();
            $dislike->user_id = $user->id;
            $dislike->image_id = (int) $image_id;
            $dislike->save();


            //CONDICION SI YA EXISTE DISdislike
            // $disdislike->delete();

            return response()->json([
                "dislike" => $dislike,
                'count' => count($dislike->image->dislikes),
                'status' => 'dislike'
            ]);
        }

    }
}
