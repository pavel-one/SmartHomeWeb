<?php

namespace App\Console\Commands;

use App\Models\DeviceStatistic;
use App\Models\UserDevice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OnlineEnded extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'online:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Завершает все активные сеансы и ставит время завершения на конец дня начала';

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
     * @return bool
     */
    public function handle(): bool
    {
        $statistics = DeviceStatistic::whereNull('end');

        $statistics->each(function ($stat) {
            /** @var DeviceStatistic $stat */
            $endDate = Carbon::create(
                $stat->start->year,
                $stat->start->month,
                $stat->start->day,
                23,
                59,
                59,
            );
            $stat->end = $endDate;
            $stat->save();
        });

        return true;
    }
}
