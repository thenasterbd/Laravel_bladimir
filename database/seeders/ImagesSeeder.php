<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'user_id' => 1,
                'image_path' => 'photo.webp',
                'description' => 'Esta es la descripción de la imagen 1.',
                'hashtag' => '#foto1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'image_path' => 'photo1.jpg',
                'description' => 'Esta es la descripción de la imagen 2.',
                'hashtag' => '#foto2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'image_path' => 'photo2.jpg', 
                'description' => 'Esta es la descripción de la imagen 3.',
                'hashtag' => '#foto3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'image_path' => 'photo3.jpeg', 
                'description' => 'Esta es la descripción de la imagen 4.',
                'hashtag' => '#foto4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'image_path' => 'photo4.webp', 
                'description' => 'Esta es la descripción de la imagen 5.',
                'hashtag' => '#foto5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
