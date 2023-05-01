<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBvonDoctorChambersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bvon_doctor_chambers', function (Blueprint $table) {
            $table->id();
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->string('chamber_name')->nullable();
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
        Schema::dropIfExists('bvon_doctor_chambers');
    }
}
