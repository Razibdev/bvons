<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sub_admin_id');
            $table->string('page_name');
            $table->string('category_name');
            $table->string('page_description');
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
        Schema::dropIfExists('create_pages');
    }
}
