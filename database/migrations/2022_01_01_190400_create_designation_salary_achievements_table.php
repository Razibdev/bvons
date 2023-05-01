<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationSalaryAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designation_salary_achievements', function (Blueprint $table) {
            $table->id();
            $table->float('MO')->default(0);
            $table->float('SMO')->default(0);
            $table->float('MEx')->default(0);
            $table->float('SMEx')->default(0);
            $table->float('RMM')->default(0);
            $table->float('MM')->default(0);
            $table->float('SMM')->default(0);
            $table->float('AGM')->default(0);
            $table->float('GM')->default(0);
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
        Schema::dropIfExists('designation_salary_achievements');
    }
}
