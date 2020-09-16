<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));

        return [
            'user_id' => self::factoryForModel(User::class),
            'make' => $this->faker->vehicleBrand,
            'model' => $this->faker->vehicleModel,
            'vin' => $this->faker->unique()->vin,
            'colour' => $this->faker->colorName,
            'year' => $this->faker->biasedNumberBetween(1970,2020, 'sqrt'),
        ];
    }
}
