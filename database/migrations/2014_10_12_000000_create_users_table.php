<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique()->index();
            $table->string('uuid')->unique()->index();
            $table->string('fuuid')->unique()->index();
            $table->boolean('verified')->default(false);
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->longText('profile_pic')->nullable();
            $table->longText('cover_pic')->nullable();
            $table->double('balance')->default(0);
            $table->text('referred_by')->nullable();
            $table->text('referral_id')->nullable()->index();
            $table->string('type')->default('GU');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
