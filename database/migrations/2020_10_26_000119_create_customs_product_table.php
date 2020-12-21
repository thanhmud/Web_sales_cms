<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomsProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customs_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('is_buy')->nullable();
            $table->tinyInteger('is_payment_online')->nullable();
            $table->tinyInteger('is_payment_code')->nullable();
            $table->tinyInteger('is_management_store')->nullable();
            $table->tinyInteger('is_report')->nullable();
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
        Schema::dropIfExists('customs_product');
    }
}
