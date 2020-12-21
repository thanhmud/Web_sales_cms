<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('type')->nullable();//1:post,2:product,3:post_Cate,4:productCate,5:URL nhập,
            $table->tinyInteger('type_id')->nullable();//1:post,2:product,3:post_Cate,4:productCate,5:URL nhập,
            $table->bigInteger('link_id')->nullable(); //id_post,id_Cate,....
            $table->integer('parent_id')->nullable();
            $table->string('icon')->nullable(); //url image
            $table->integer('stt')->default(0);//stt hiển thị
            $table->string('url')->nullable()->nullable();//khi type =5 thi được nhập trương này
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
        Schema::dropIfExists('menu');
    }
}
