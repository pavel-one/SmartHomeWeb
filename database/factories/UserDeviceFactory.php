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
        return [
            'user_id' => 1,
            'name' => $this->faker->word,
            'online' => $this->faker->boolean,
            'mac' => $this->faker->macAddress,
            'signal' => mt_rand(1, 20) / 10
        ];
    }
}
