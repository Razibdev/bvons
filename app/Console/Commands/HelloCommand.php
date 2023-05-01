<?php

namespace App\Console\Commands;

use App\Modal\CommissionRelation;
use Illuminate\Console\Command;

class HelloCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Hello:world';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $commission->postLikeCommissionSetting();
        $commission->postCommentCommissionSetting();
        $commission->postShareCommissionSetting();



        //for account activation user

        $commission->userActivationCheck();

        sleep(1);


//        $commission->BPTOAMCount();
//        $commission->AMToDisMCount();
//        $commission->DisMToDivMCount();
//        $commission->DivMToBDMCount();
        info('Hello world');
        return 0;

    }
}
