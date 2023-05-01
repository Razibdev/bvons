<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_orders', function (Blueprint $table) {
            $table->id();
            $table->double('order_amount');
            $table->string('order_serial');
            $table->string('order_status')->default("pending");
            $table->string('payment_status')->default("pending");
            $table->unsignedBigInteger('user_id');
            $table->longText('address');
            $table->longText('complete_order_detail')->nullable();
            $table->unsignedBigInteger('seen_status')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eco_orders');
    }
}
