<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->bigInteger('favicon')->nullable(); //icon trên trình duyệt
            $table->bigInteger('share_icon')->nullable(); //icon trên trình duyệt
            $table->bigInteger('hotline')->nullable();
            $table->string('email')->nullable();
            $table->text('copyright')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('google')->nullable();
            $table->text('youtube')->nullable();
            $table->text('pinterest')->nullable();
            $table->text('instagram')->nullable();
            $table->text('iframe_map')->nullable();
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
        Schema::dropIfExists('company');
    }
}
