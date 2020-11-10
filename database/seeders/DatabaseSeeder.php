<?php

namespace Database\Seeders;

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
        \DB::table('users')->insert([
            'name' => 'Павел Зарубин',
            'email' => 'pavel@orendat.ru',
            'password' => \Hash::make('tipira21')
        ]);
         \App\Models\User::factory(10)->create();
    }
}
