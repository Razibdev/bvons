<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorChamberTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_chamber_tokens', function (Blueprint $table) {
            $table->id();
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('chamber_id')->nullable();
            $table->string('appointment_date')->nullable();
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
        Schema::dropIfExists('doctor_chamber_tokens');
    }
}
