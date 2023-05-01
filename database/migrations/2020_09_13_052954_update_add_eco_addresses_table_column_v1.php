<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddEcoAddressesTableColumnV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eco_addresses', function (Blueprint $table) {
            $table->string('postal_code')->after('address')->nullable();
            $table->string('house_no')->after('address')->nullable();
            $table->string('road_no')->after('address')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('ps')->after('address')->nullable();
            $table->string('district')->after('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eco_addresses', function (Blueprint $table) {
            $table->dropColumn(['city', 'district', 'ps', 'postal_code', 'road_no', 'house_no']);
        });
    }
}
