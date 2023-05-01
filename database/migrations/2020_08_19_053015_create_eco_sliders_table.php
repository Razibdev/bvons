<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('sliders_type');
            $table->string('sliders_name');
            $table->tinyInteger('sliders_status')->default(1);
            $table->string('sliders_image')->default('slider/sampleimage.jpg');
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
        Schema::dropIfExists('eco_sliders');
    }
}
