<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmiDetails;
use Illuminate\Support\Carbon;

class UpdatestatusDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateStatus:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status at midnight';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $date = Carbon::now()->format('Y-m-d');
        $jobs = EmiDetails::select('status', 'emi_due_date')->where('status','=','Pending')->where('emi_due_date', '=', $date)->update(['status' => 'Due']);
       // dd($jobs);
        $this->info($jobs);
    }
}
