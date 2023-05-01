<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBvonDoctorRegisterHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bvon_doctor_register_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('district_officer_id')->nullable();
            $table->integer('upazilla_officer_id')->nullable();
            $table->integer('field_officer_id')->nullable();
            $table->date('register_date')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('account')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('bvon_doctor_register_histories');
    }
}
