<?php

namespace App\Console\Commands;

use App\Models\DeviceStatistic;
use App\Models\UserDevice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OnlineEnded extends Command
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'online:end {--hour}';

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
        if ($this->option('hour')) {
            return $this->endHour();
        }

        return $this->endAll();
    }

    private function endAll(): bool
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

    private function endHour(): bool
    {
        $startDate = Carbon::now()->addHours(-1)->set([
            'second' => 0,
            'minute' => 0
        ]);
        $endDate = Carbon::now()->set([
            'second' => 0,
            'minute' => 0
        ]);

        $statistics = DeviceStatistic::whereNull('end')
            ->where('start', '>=', $startDate->format(self::DATE_FORMAT));

        $statistics->each(function ($stat) use ($endDate) {
            /** @var DeviceStatistic $stat */
            $stat->end = $endDate;
            $stat->save();

            $stat->device->statistic()->create([
                'start' => $endDate
            ]);
        });

        return true;
    }
}
