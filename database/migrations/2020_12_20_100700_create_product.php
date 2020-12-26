<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->biginteger('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('category');
            $table->text('desciption');
            $table->string('image_path');
            $table->decimal('amount', 8, 2);
            $table->timestamps();
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->biginteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product');
            $table->integer('qty')->unsigned();
            $table->timestamps();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment');
            $table->biginteger('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('cart');
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
        Schema::dropIfExists('order');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('product');
        Schema::dropIfExists('category');
    }
}
