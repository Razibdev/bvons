<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_sizes', function (Blueprint $table) {
            $table->id();
            $table->text('all_size');
            $table->unsignedBigInteger('subcategories_id');
            $table->timestamps();
            $table->foreign('subcategories_id')->references('id')->on('eco_sub_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eco_sizes');
    }
}
