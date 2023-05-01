<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('l_add_new')->default(0);
            $table->integer('m_add_new')->default(0);
            $table->integer('r_add_new')->default(0);
            $table->integer('total_left')->default(0);
            $table->integer('total_middle')->default(0);
            $table->integer('total_right')->default(0);
            $table->integer('l_left_over')->default(0);
            $table->integer('l_middle_over')->default(0);
            $table->integer('l_right_over')->default(0);
            $table->integer('minimum')->default(0);
            $table->integer('match_limit')->default(30);
            $table->integer('amount')->default(0);
            $table->date('now_date')->nullable();
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
        Schema::dropIfExists('daily_histories');
    }
}
