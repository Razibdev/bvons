<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcoPercelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bco_percels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bco_percel_type_id');
            $table->string('name');
            $table->string('tracking_number');
            $table->double('weight');
            $table->text('images');
            $table->text('qr_image');
            $table->text('sender_name');
            $table->text('sender_phone');
            $table->text('pickup_address');
            $table->string('pickup_geo_location');
            $table->text('receiver_name');
            $table->text('receiver_phone');
            $table->text('receiver_address');
            $table->string('receiver_geo_location');
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
        Schema::dropIfExists('bco_percels');
    }
}
