<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Image;

class DashboardController extends Controller
{

    public function index()
    {
        $images = Image::orderBy('id', 'desc')->paginate(5);

        return view('dashboard', [
            'images' => $images
        ]);
    }



}
