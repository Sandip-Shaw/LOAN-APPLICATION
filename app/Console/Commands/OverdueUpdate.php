<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmiDetails;
use Illuminate\Support\Carbon;

class OverdueUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'overdue:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'overdue status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
       
        sleep(10);
       
        $jobss = EmiDetails::select('emi_date','status')->where('status','=','Due')->where('emi_date', '<=', now()->addDays(-3)->toDateTimeString())->update(['status' => 'OverDue']);

        $this->info($jobss);
    }
}
