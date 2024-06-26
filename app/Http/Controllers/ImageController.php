<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Dislike;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        return view("image.create");
    }

    public function save(Request $request)
    {
        $validate = $request->validate([
            'description' => ['required'],
            'image_path' => ['required', 'mimes:jpg,png,gif,wpeg,jpeg,svg,webp'],
            'hashtag' => ['required'],
        ]);


        $image_path = $request->file("image_path");
        $description = $request->input("description");
        $hashtag = $request->input("hashtag");

        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;

        $image->description = $description;

        $image->hashtag = $hashtag;

        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            $image->image_path = $image_path_name;
        }

        $image->save();

        return Redirect::route('dashboard')->with('status', 'post-created');
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id)
    {
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();
        $dislikes = Dislike::where('image_id', $id)->get();

        if ($user && $image && $image->user->id == $user->id) {
            //DELETE COMMENT
            if ($comments && count($comments) > 0) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            //DELETE LIKES
            if ($likes && count($likes) > 0) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // DELETE DISLIKES
            if ($dislikes && count($dislikes) > 0) {
                foreach ($dislikes as $dislike) {
                    $dislike->delete();
                }
            }

            //DELETE IMAGES ON STORAGE
            Storage::disk('images')->delete($image->image_path);

            //DELETE REGISTER OF IMAGE
            $image->delete();

            //MESSAGE
            $status = array('status' => 'image-deleted');
        } else {
            $status = array('status' => 'image-not-deleted');
        }
        return Redirect::route('dashboard')->with($status);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', [
                'image' => $image
            ]);
        } else {
            return Redirect::route('dashboard');
        }
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'description' => ['required'],
            'hashtag' => ['required'],
            'image_path' => ['image'],
        ]);

        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');
        $hashtag = $request->input('hashtag');

        $image = Image::find($image_id);
        $image->description = $description;
        $image->hashtag = $hashtag;

        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->update();

        return Redirect::route('image.detail', ['id' => $image_id])->with('status', 'post-updated');
    }
// finder and searchs
    public function finder(Request $request)
    {
        $query = Image::query();
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'default');
        if ($search) {
            $query->where('tag', 'LIKE', '%' . $search . '%');
        }
        switch ($sortBy) {
            case 'likes':
                $query->leftJoinSub(
                    'SELECT image_id, COUNT(*) as likes_count FROM likes GROUP BY image_id',
                    'likes',
                    'images.id',
                    '=',
                    'likes.image_id'
                );
                $query->orderByDesc('likes.likes_count');
                break;
            case 'dislikes':
                $query->leftJoinSub(
                    'SELECT image_id, COUNT(*) as dislikes_count FROM dislikes GROUP BY image_id',
                    'dislikes',
                    'images.id',
                    '=',
                    'dislikes.image_id'
                );
                $query->orderByDesc('dislikes.dislikes_count');
                break;
            case 'comments':
                $query->leftJoinSub(
                    'SELECT image_id, COUNT(*) as comments_count FROM comments GROUP BY image_id',
                    'comments',
                    'images.id',
                    '=',
                    'comments.image_id'
                );
                $query->orderByDesc('comments.comments_count');
                break;
            case 'recent':
                $query->orderByDesc('id');
                break;
            case 'oldest':
                $query->orderBy('id');
                break;
            default:
                $query->orderByDesc('id');
                break;
        }
        $images = $query->paginate(5);
        return view('image.finder', [
            'images' => $images,
            'search' => $search,
            'sortBy' => $sortBy
        ]);
    }

}