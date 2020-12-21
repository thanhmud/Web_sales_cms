<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable();
            $table->string('title');
            $table->text('short_content')->nullable();
            $table->text('content')->nullable();
            $table->double('price')->nullable();
            $table->double('promotion_price')->default(0);
            $table->double('count')->default(0);
            $table->string('product_media_id')->nullable();
            // $table->string('unit')->nullable();
            // $table->integer('soluong')->default(0);
            // $table->integer('daban')->default(0);
            // $table->string('size')->nullable();
            // $table->date('ngaysx')->nullable();
            // $table->date('hansd')->nullable();
            // $table->unsignedBigInteger('product_media_id');
            // $table->foreign('product_media_id')->references('id')->on('media')->onDelete('cascade');
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
        Schema::dropIfExists('product');
    }
}
