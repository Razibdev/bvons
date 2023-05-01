<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorMemberPinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_member_pins', function (Blueprint $table) {
            $table->id();
            $table->string('pincode');
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('account')->nullable();
            $table->boolean('sold')->default(0);
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
        Schema::dropIfExists('doctor_member_pins');
    }
}
