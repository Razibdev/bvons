<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marchants', function (Blueprint $table) {
            $table->id();
            $table->string('referral_id');
            $table->integer('user_id');
            $table->string('address');
            $table->string('type');
            $table->string('email');
            $table->string('password');
            $table->string('merchant_account');
            $table->float('payment_charge');
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
        Schema::dropIfExists('marchants');
    }
}
