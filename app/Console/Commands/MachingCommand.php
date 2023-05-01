<?php

namespace App\Console\Commands;

use App\Modal\CommissionRelation;
use Illuminate\Console\Command;

class MachingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'match:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Match Command description';

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
        $commission->matrixHistory();
        sleep(30);

        $commission->designationChange();
//        sleep(5);
//        $commission->levelMachNow();

        $commission->designationDailyUpdateInfo();
        $commission->designationMonthlyUpdateInfo();

        return 0;
    }
}
