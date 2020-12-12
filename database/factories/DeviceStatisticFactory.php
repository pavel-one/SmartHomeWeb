<?php

namespace Database\Factories;

use App\Models\DeviceStatistic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceStatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeviceStatistic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::now();

        return [
            'start' => Carbon::now()->addDays(-rand(0, 10)),
            'end' => Carbon::now()->addMinutes(-rand(0, 6000))
        ];
    }
}
