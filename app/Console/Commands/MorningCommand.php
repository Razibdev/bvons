<?php

namespace App\Console\Commands;

use App\Modal\CommissionRelation;
use Illuminate\Console\Command;

class MorningCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'morning:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Morning Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $commission = new CommissionRelation();
        // count Post and User
        $commission->postCount();
        $commission->userCount();

        //commission Distribution
        $commission->totalLikeCommission();
        $commission->perUserLikePerDayCommission();
        $commission->totalCommentCommission();
        $commission->perUserCommentPerDayCommission();
        $commission->totalShareCommission();
        $commission->perUserSharePerDayCommission();


        return 0;
    }
}
