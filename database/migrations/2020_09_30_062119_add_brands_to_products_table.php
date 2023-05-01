<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrandsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eco_products', function (Blueprint $table) {
           $table->unsignedBigInteger('brand_id')->nullable();
           $table->string('product_model')->nullable();;

            $table->foreign('brand_id')->references('id')->on('eco_brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eco_products', function (Blueprint $table) {
            //
        });
    }
}
