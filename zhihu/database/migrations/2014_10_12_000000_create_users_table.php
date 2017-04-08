<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar');
            $table->string('confirmationToken');
            $table->smallInteger('isActive')->default(0);
            $table->integer('questionsCount')->default(0);
            $table->integer('answersCount')->default(0);
            $table->integer('commentsCount')->default(0);
            $table->integer('likesCount')->default(0);
            $table->integer('followersCount')->default(0);
            $table->integer('followingsCount')->default(0);
            $table->integer('settings')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
