<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('blood_group')->nullable();
            $table->text('address')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('contact1')->nullable();
            $table->string('contact2')->nullable();
            $table->string('contact3')->nullable();
            $table->text('cause')->nullable();
            $table->date('blood_date')->nullable();
            $table->time('blood_time')->nullable();
            $table->integer('blood_bag')->default(0);
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
        Schema::dropIfExists('blood_statuses');
    }
}
