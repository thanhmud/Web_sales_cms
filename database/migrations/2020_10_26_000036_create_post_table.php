<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable();
            $table->string('title');
            $table->tinyInteger('content')->nullable();
            $table->text('type')->default(0);
            $table->double('count')->default(0);
            $table->string('length_expect')->nullable(); //số kí tự muốn hiện ở short content
            $table->string('allow_comment')->nullable();
            $table->bigInteger('media_id')->nullable();
            // $table->unsignedBigInteger('media_id');
            // $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('post');
    }
}
