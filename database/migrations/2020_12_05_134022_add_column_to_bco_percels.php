<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBcoPercels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bco_percels', function (Blueprint $table) {
            $table->unsignedBigInteger('receiver_user_id')->after('bco_percel_type_id')->nullable();
            $table->string('pickup_code')->after('tracking_number');
            $table->double('offer_price')->after('name')->nullable();
            $table->string('status')->after('receiver_geo_location')->default('waiting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bco_percels', function (Blueprint $table) {
            $table->dropColumn(['receiver_user_id', 'pickup_code', 'status', 'offer_price']);
        });
    }
}
