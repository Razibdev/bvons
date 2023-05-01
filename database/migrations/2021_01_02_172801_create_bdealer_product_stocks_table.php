<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBdealerProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdealer_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bdealer_id');
            $table->unsignedBigInteger('product_id');
            $table->string('name')->nullable();
            $table->text('message')->nullable();
            $table->string('type');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('bdealer_id')->references('id')->on('bdealers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('eco_products')->onDelete('cascade');
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
        Schema::dropIfExists('bdealer_product_stocks');
    }
}
