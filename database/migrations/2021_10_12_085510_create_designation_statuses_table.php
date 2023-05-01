<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designation_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('MO')->nullable();
            $table->string('SMO')->nullable();
            $table->string('Mex')->nullable();
            $table->string('SMex')->nullable();
            $table->string('RMM')->nullable();
            $table->string('MM')->nullable();
            $table->string('SMM')->nullable();
            $table->string('AGM')->nullable();
            $table->string('GM')->nullable();
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
        Schema::dropIfExists('designation_statuses');
    }
}
