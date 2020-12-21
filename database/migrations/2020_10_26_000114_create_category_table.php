<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('stt')->default(0);
            $table->text('desc')->nullable();
            $table->integer('parent_id')->nullable();
            $table->bigInteger('media_id')->nullable();//bảng media
            $table->tinyInteger('type')->nullable(); // 1 post ; 2 product
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
        Schema::dropIfExists('category');
    }
}
