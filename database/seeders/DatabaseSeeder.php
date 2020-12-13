<?php

namespace Database\Seeders;

use App\Models\DeviceStatistic;
use App\Models\User;
use App\Models\UserDevice;
use App\Services\DeviceService;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $service = resolve(DeviceService::class);

        User::factory(10)
            ->has(
                $service->deviceFactory(),
                'devices'
            )
            ->create();
    }
}
