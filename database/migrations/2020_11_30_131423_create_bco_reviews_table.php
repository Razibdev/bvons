<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcoReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bco_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bco_shipment_id');
            $table->unsignedBigInteger('poster_id');
            $table->unsignedBigInteger('receiver_id');
            $table->string('type');
            $table->double('point');
            $table->double('comment');
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
        Schema::dropIfExists('bco_reviews');
    }
}
