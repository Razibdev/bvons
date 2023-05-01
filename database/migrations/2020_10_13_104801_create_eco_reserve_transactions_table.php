<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoReserveTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_reserve_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eco_order_id');
            $table->unsignedBigInteger('eco_order_details_id');
            $table->unsignedBigInteger('eco_product_id');
            $table->double('amount');
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('eco_reserve_transaction');
    }
}
