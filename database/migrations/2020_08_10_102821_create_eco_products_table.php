<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('description');
            $table->text('product_size');
            $table->integer('product_promote')->nullable();
            $table->string('product_permision')->default('pending');
            $table->integer('product_discount')->default(0);
            $table->integer('product_visibility')->default(0);
            $table->integer('product_quantity');

            $table->double('production_price')->default(0);
            $table->double('bvon_price')->default(0);
            $table->double('store_amount')->default(0);
            $table->double('sr_amount')->default(0);
            $table->double('premium_price')->default(0);
            $table->double('user_price')->default(0);
            $table->double('can_use_cashback')->default(0);

            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->timestamps();


            $table->foreign('vendor_id')->references('id')->on('eco_vendors')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('eco_shops')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('eco_categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('eco_sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eco_products');
    }
}
