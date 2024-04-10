<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\FormatTime;

class ProfileController extends Controller
{

    public function index($search = null)
    {
        if (!empty($search)) {
            $users = User::where('nick', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('surname', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate(5);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(5);
        }

        return view('user.index', [
            'users' => $users
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->remember_token = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile photo.
     */
    public function updatePhoto(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $image_path = $request->file('image_path');
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            $user->image = $image_path_name;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'photo-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function config(Request $request): View
    {
        return view('user.config', [
            'user' => $request->user(),
        ]);
    }

    public function updateUser(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->remember_token = null;
        }

        $request->user()->save();

        return Redirect::route('user.config')->with('status', 'profile-updated');
    }

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }


    public function profile($id)
    {
        $user = User::find($id);

        return view('user.profile', [
            'user' => $user
        ]);
    }

}