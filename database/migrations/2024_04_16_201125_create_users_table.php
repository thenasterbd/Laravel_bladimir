<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role', 20);
            $table->string('name', 255);
            $table->string('surname', 200);
            $table->string('nick', 100);
            $table->string('email', 255)->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
