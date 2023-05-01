<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->text('shop_address');
            $table->string('shop_image')->default('shop/sampleimage.jpg');
            $table->unsignedBigInteger('vendor_id');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('eco_vendors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eco_shops');
    }
}
