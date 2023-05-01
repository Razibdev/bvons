<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnToBdealerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bdealer_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_to')->after('bdealer_id')->nullable();
            $table->string('pin')->after('serial')->nullable();
            $table->foreign('assigned_to')->references('id')->on('bdealers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('bdealer_orders', function (Blueprint $table) {
            $table->dropColumn(['assigned_to', 'pin']);
        });
    }
}
