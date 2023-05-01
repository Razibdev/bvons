<?php

namespace App\Console\Commands;

use App\Modal\CommissionRelation;
use Illuminate\Console\Command;

class EveingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evening:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Evening Command description';

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

        $commission->totalPerDateLikeCommissionHit();
        $commission->totalPerDateCommentCommissionHit();
        $commission->totalPerDateShareCommissionHit();
        $commission->postAction();




        $like = $commission->totalPerDateLikeCommissionNotHit();
        $comment = $commission->totalPerDateCommentCommissionNotHit();
        $share = $commission->totalPerDateShareCommissionNotHit();

        $commission->dailyTopCountSellerCommissionSetting();

        sleep(1);
        $commission->updateReservedFun($like);
        $commission->updateReservedFunComment($comment);
        $commission->updateReservedFunShare($share);

        $commission->designationChange();
        sleep(1);
        $commission->levelMachNow();
        sleep(1);
        $commission->totalCommissionSellNow();
        sleep(1);
        $commission->designationCommissionDesignation();

        return 0;
    }
}
