<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->foreign(['image_id'], 'fk_likes_images')->references(['id'])->on('images')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'], 'fk_likes_users')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign('fk_likes_images');
            $table->dropForeign('fk_likes_users');
        });
    }
};
