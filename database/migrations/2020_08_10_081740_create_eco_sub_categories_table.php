<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('sub_category_name')->unique();
            $table->unsignedBigInteger('category_id');
            $table->string('subcategories_image')->default('subcategory/sampleimage.jpg');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('eco_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eco_sub_categories');
    }
}
