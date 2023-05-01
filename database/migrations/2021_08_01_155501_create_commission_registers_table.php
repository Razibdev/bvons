<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_registers', function (Blueprint $table) {
            $table->id();
            $table->integer('post_like');
            $table->integer('post_comment');
            $table->integer('post_share');
            $table->integer('incentive_reward');
            $table->integer('instant_bonus');
            $table->integer('daily_top_seller_bonus');
            $table->integer('weakly_top_seller_bonus');
            $table->integer('monthly_top_seller_bonus');
            $table->integer('leader_bonus');
            $table->integer('dealer_point_bonus');
            $table->integer('company_profit');
            $table->integer('reserved_fund');
            $table->integer('company_management');
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
        Schema::dropIfExists('commission_registers');
    }
}
