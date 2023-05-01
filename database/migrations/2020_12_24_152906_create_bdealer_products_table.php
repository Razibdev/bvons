<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdealerProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdealer_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('bdealer_type_id');
            $table->double('purchase_price');
            $table->integer('minimum_quantity');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('eco_products')->onDelete('cascade');
            $table->foreign('bdealer_type_id')->references('id')->on('bdealer_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('bdealer_products');
    }
}
