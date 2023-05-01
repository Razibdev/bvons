<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EcoAddSubCatIdColumnToEcoBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eco_brands', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_category_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eco_brands', function (Blueprint $table) {
            $table->dropColumn('sub_category_id');
        });
    }
}
