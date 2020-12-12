<?php

namespace Database\Seeders;

use App\Models\DeviceStatistic;
use App\Models\User;
use App\Models\UserDevice;
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
         User::factory(10)
             ->has(
                 UserDevice::factory()
                     ->has(
                         DeviceStatistic::factory()
                             ->count(100),
                         'statistic'
                     )
                 ->count(10),
                 'devices'
             )
             ->create();

         /** @var User $user */
         $user = User::whereId(1)->first();
         $user->email = 'pavel@orendat.ru';
         $user->password = Hash::make('tipira21');
         $user->save();
    }
}
