<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CommentsSeeder::class);
        $this->call(DislikesSeeder::class);
        $this->call(ImagesSeeder::class);
        $this->call(LikesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}

