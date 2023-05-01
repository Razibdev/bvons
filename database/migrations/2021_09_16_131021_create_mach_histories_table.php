<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mach_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('left_position');
            $table->string('middle_position');
            $table->string('right_position');
            $table->string('designation');
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
        Schema::dropIfExists('mach_histories');
    }
}
