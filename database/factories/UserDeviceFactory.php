<?php

namespace Database\Factories;

use App\Models\UserDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDevice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = UserDevice::getKeys();

        $names = [
            UserDevice::TYPE_HEATER => 'Мой обогреватель',
            UserDevice::TYPE_SWITCHER => 'Свет на компьютерном столе',
        ];

        $type = $types[rand(0, count($types) - 1)];

        return [
            'name' => $names[$type],
            'online' => $this->faker->boolean,
            'mac' => $this->faker->macAddress,
            'type' => $type,
            'signal' => mt_rand(1, 20) / 10
        ];
    }
}
