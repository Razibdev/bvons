<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorRenewPincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_renew_pincodes', function (Blueprint $table) {
            $table->id();
            $table->string('pincode')->nullable();
            $table->string('type')->nullable();
            $table->integer('month')->default(0);
            $table->string('name')->nullable();
            $table->string('account')->nullable();
            $table->string('sold')->nullable();
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
        Schema::dropIfExists('doctor_renew_pincodes');
    }
}
