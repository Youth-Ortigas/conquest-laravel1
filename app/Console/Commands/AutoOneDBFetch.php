<?php

namespace App\Console\Commands;

use App\Services\ServicesAutoOneDB;
use Illuminate\Console\Command;
use App\Services\TimeTrackerService;

class AutoOneDBFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:autoonedbfetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch list of registered users';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $servicesAutoOneDBFetch = new ServicesAutoOneDB();
        \Log::info('-- START: Fetch One DB Nation --');
        $resultData = $servicesAutoOneDBFetch->consoleFetchSaveData();
        \Log::info('-- END: Fetch One DB Nation --');
    }

}
