<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('account');
            $table->string('phone');
            $table->string('blood');
            $table->string('image');
            $table->string('validate_date');
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
        Schema::dropIfExists('id_carts');
    }
}
