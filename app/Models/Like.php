<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
        // return $this->belongsTo('App\User, 'user_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
        // return $this->belongsTo('App\Image, 'image_id');
    }
}