<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role' => 'admin',
                'name' => 'Admin',
                'surname' => 'Admin',
                'nick' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'image' => 'avatar.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => null,
            ],
            [
                'role' => 'user',
                'name' => 'John',
                'surname' => 'Doe',
                'nick' => 'john_doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'image' => 'avatar.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => null,
            ],
            [
                'role' => 'user',
                'name' => 'Jane',
                'surname' => 'Doe',
                'nick' => 'jane_doe',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'image' => 'avatar.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => null,
            ],
            [
                'role' => 'user',
                'name' => 'Alice',
                'surname' => 'Smith',
                'nick' => 'alice_smith',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'image' => 'avatar.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => null,
            ],
            [
                'role' => 'user',
                'name' => 'Bob',
                'surname' => 'Johnson',
                'nick' => 'bob_johnson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'image' => 'avatar.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => null,
            ],
        ]);
    }
}
