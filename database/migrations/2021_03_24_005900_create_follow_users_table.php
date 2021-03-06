<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('follow_users')) {
            Schema::create('follow_users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('followed_user_id')->index();
                $table->unsignedBigInteger('following_user_id')->index();
                $table->foreign('followed_user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('following_user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
    
                $table->unique(['followed_user_id', 'following_user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_users');
    }
}
