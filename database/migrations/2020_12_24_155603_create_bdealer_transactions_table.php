<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdealerTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdealer_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bdealer_id');
            $table->unsignedBigInteger('bdealer_transaction_category_id');
            $table->string('type');
            $table->double('amount');
            $table->json('data')->nullable();
            $table->longText('message')->nullable();
            $table->timestamps();
            $table->foreign('bdealer_id')->references('id')->on('bdealers')->onDelete('cascade');
            $table->foreign('bdealer_transaction_category_id')->references('id')->on('bdealer_transaction_categories')->onDelete('cascade');
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
        Schema::dropIfExists('bdealer_transactions');
    }
}
