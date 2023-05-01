<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_officers', function (Blueprint $table) {
            $table->id();
            $table->integer('district_officer_id')->nullable();
            $table->integer('upazilla_officer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('account')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('field_officers');
    }
}
