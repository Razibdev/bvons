<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('category')->nullable();
            $table->string('amount_type')->nullable();
            $table->string('amount')->nullable();
            $table->longText('data')->nullable();
            $table->longText('message')->nullable();
            $table->date('check_date')->nullable();
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
        Schema::dropIfExists('shopping_wallet_transactions');
    }
}
