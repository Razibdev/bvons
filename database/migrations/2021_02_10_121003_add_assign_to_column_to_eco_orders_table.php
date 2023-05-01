<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAssignToColumnToEcoOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eco_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('assign_bdealer_id')->after('id')->nullable();
            $table->foreign('assign_bdealer_id')->references('id')->on('bdealers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eco_orders', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->dropColumn('assign_bdealer_id');
        });
    }
}
