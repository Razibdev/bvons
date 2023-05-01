<?php

namespace App\Console\Commands;

use App\Modal\CommissionRelation;
use Illuminate\Console\Command;

class MonthlyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Top Seller Monthly bonus';

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
        $commission->monthlyTopCountSellerCommissionSetting();
        $commission->leaderAmDisMDivMBDMCommissionSetting();
        $commission->designationCommissionDesignation();
        info('Monthly Top Seller Bonus');
        return 0;
    }
}
