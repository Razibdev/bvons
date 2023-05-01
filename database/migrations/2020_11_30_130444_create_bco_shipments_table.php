<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcoShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bco_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bco_request_id');
            $table->unsignedBigInteger('bco_delivery_boy_id');
            $table->unsignedBigInteger('bco_percel_id');
            $table->text('geo_location');
            $table->string('status')->default('waiting');
            $table->tinyInteger('is_reviewed_by_sender')->default(0);
            $table->tinyInteger('is_reviewed_by_delivery_boy')->default(0);
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
        Schema::dropIfExists('bco_shipments');
    }
}
