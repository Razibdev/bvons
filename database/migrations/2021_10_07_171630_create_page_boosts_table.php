<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageBoostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_boosts', function (Blueprint $table) {
            $table->id();
            $table->integer('boost_type_id')->nullable();
            $table->string('customer_age');
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->string('device_id')->nullable();
            $table->string('number_operator')->nullable();
            $table->string('hobby')->nullable();
            $table->string('education_institution')->nullable();
            $table->string('company_job_type')->nullable();
            $table->string('team_id')->nullable();
            $table->string('page_people_in_not')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('budget')->default(0);
            $table->integer('audience_number')->default(0);
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
        Schema::dropIfExists('page_boosts');
    }
}
