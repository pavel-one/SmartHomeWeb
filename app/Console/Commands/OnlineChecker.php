<?php

namespace App\Console\Commands;

use App\Models\UserDevice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OnlineChecker extends Command
{
    protected const TTL = 120; //Время в секундах сброса онлайна

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'online';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка устройств онлайн';

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
        $this->withProgressBar(UserDevice::all(), function ($device) {

            /** @var UserDevice $device */
            $diff = Carbon::createFromTimeString($device->last_check)->diffInSeconds(Carbon::now());

            \Log::info("TEST SCHEDULE $device->id");

            if ($diff > self::TTL) {
                $this->info("Устройство id {$device->id} OFFLINE");
                $device->offline();
            }
        });

        return true;
    }
}
