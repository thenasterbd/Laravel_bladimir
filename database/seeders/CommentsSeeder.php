<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'user_id' => 1,
                'image_id' => 1,
                'content' => 'Este es un comentario de ejemplo 1.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'image_id' => 1,
                'content' => 'Este es un comentario de ejemplo 2.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'image_id' => 2,
                'content' => 'Este es un comentario de ejemplo 3.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'image_id' => 2,
                'content' => 'Este es un comentario de ejemplo 4.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'image_id' => 3,
                'content' => 'Este es un comentario de ejemplo 5.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
