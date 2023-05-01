<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdealerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdealer_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bdealer_id');
            $table->string('serial');
            $table->double('amount');
            $table->string('status');
            $table->tinyInteger('seen_status')->default(0);
            $table->text('delivery_address');
            $table->timestamps();
            $table->foreign('bdealer_id')->references('id')->on('bdealers')->onDelete('cascade');

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
        Schema::dropIfExists('bdealer_orders');
    }
}
