<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('id_customer');
            // $table->foreign('id_customer')->references('id')->on('customer')->onDelete('cascade');
            // $table->date('date_order');
            $table->double('total');
            // $table->string('payment');
            $table->text('note');
            $table->string('status');
            $table->timestamps();
            $table->string('send_name')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
