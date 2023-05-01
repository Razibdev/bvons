<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharityTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('charity_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('category')->nullable();
            $table->string('amount_type')->nullable();
            $table->float('amount')->default(0);
            $table->string('data')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('charity_transactions');
    }
}
