<?php

namespace App\Console\Commands;

use App\Modal\CommissionRelation;
use Illuminate\Console\Command;

class WeeklyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly top seller bonus';

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

        $commission->weeklyTopCountSellerCommissionSetting();
        info('Weekly Top Seller bonus');

        return 0;
    }
}
