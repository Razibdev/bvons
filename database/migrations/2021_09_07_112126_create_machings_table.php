<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('left_position');
            $table->string('middle_position');
            $table->string('right_position');
            $table->string('minimum');
            $table->string('p_m_amount');
            $table->string('total');
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
        Schema::dropIfExists('machings');
    }
}
