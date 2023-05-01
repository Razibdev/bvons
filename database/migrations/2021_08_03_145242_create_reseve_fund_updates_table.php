<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReseveFundUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseve_fund_updates', function (Blueprint $table) {
            $table->id();
            $table->integer('post_like_reserve');
            $table->integer('post_comment_reserve');
            $table->integer('post_share_reserve');
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
        Schema::dropIfExists('reseve_fund_updates');
    }
}
