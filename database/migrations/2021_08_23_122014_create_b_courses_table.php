<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_courses', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('course_name');
            $table->text('course_description');
            $table->string('live_class')->nullable();
            $table->text('course_feature')->nullable();
            $table->string('course_price');
            $table->string('current_price');
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
        Schema::dropIfExists('b_courses');
    }
}
