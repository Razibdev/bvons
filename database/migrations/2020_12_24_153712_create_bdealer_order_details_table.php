<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdealerOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdealer_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bdealer_order_id');
            $table->json('product_json');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('bdealer_order_id')->references('id')->on('bdealer_orders')->onDelete('cascade');

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
        Schema::dropIfExists('bdealer_order_details');
    }
}
