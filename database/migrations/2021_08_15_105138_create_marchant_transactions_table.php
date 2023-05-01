<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarchantTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marchant_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('referral_id')->nullable();
            $table->string('category');
            $table->string('amount_type');
            $table->string('amount');
            $table->string('data')->nullable();
            $table->string('message')->nullable();
            $table->date('check_date');
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
        Schema::dropIfExists('marchant_transactions');
    }
}
