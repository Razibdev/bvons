<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBdealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdealers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bdealer_id')->nullable();
            $table->unsignedBigInteger('bdealer_reference_id')->nullable();
            $table->unsignedBigInteger('bdealer_type_id')->nullable();
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('thana_id');
            $table->unsignedBigInteger('village_id');

            $table->text('pic');
            $table->text('nid_pic_front');
            $table->text('nid_pic_back');
            $table->text('ecucation_cert_pic')->nullable();
            $table->string('business_type')->nullable();
            $table->text('comment_about_business')->nullable();
            $table->text('contact')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('shop_geo')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bdealer_id')->references('id')->on('bdealers')->onDelete('cascade');
            $table->foreign('bdealer_reference_id')->references('id')->on('bdealers')->onDelete('cascade');
            $table->foreign('bdealer_type_id')->references('id')->on('bdealer_types')->onDelete('cascade');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('thana_id')->references('id')->on('thanas')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
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
        Schema::dropIfExists('bdealers');
    }
}
