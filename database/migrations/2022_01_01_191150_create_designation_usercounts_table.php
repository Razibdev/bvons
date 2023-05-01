<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationUsercountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designation_usercounts', function (Blueprint $table) {
            $table->id();
            $table->integer('package')->default(0);
            $table->integer('MO')->default(0);
            $table->integer('SMO')->default(0);
            $table->integer('MEx')->default(0);
            $table->integer('SMEx')->default(0);
            $table->integer('RMM')->default(0);
            $table->integer('MM')->default(0);
            $table->integer('SMM')->default(0);
            $table->integer('AGM')->default(0);
            $table->integer('GM')->default(0);
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
        Schema::dropIfExists('designation_usercounts');
    }
}
