<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDevice;
use Database\Factories\UserDeviceFactory;
use DB;
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
        DB::table('users')->insert([
            'name' => 'Павел Зарубин',
            'email' => 'pavel@orendat.ru',
            'password' => \Hash::make('tipira21')
        ]);
         User::factory(10)->create();
         UserDevice::factory(10)->create();
    }
}
