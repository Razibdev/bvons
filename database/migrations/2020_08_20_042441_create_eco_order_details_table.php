<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_order_details', function (Blueprint $table) {
            $table->id();
            $table->double('product_price');
            $table->integer('product_quantity');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('eco_products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('eco_orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eco_order_details');
    }
}
