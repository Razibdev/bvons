<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcoRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bco_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bco_delivery_boy_id');
            $table->unsignedBigInteger('bco_percel_id');
            $table->double('offer_price');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('bco_requests');
    }
}
