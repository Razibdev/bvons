<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTableOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('device_id')->after('cover_pic');
            $table->string('nick_name')->after('cover_pic')->nullable();
            $table->string('occupation')->after('cover_pic')->nullable();
            $table->date('birthday')->after('cover_pic')->nullable();
            $table->string('religion')->after('cover_pic')->nullable();
            $table->mediumText('lives_in')->after('cover_pic')->nullable();
            $table->mediumText('hometown')->after('cover_pic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('device_id');
            $table->dropColumn('nick_name');
            $table->dropColumn('occupation');
            $table->dropColumn('birthday');
            $table->dropColumn('religion');
            $table->dropColumn('lives_in');
            $table->dropColumn('hometown');
        });
    }
}
