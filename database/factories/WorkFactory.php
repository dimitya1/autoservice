<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Mechanic;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WorkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Work::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (rand(0, 1) == 1) {
            $status = 1;
            $result = $this->faker->realText(150);
            $price = rand(100, 27000);
        } else {
            $status = 0;
            $result = null;
            $price = null;
        }

        return [
            'user_id' => self::factoryForModel(User::class),
            'car_id' => self::factoryForModel(Car::class),
            'mechanic_id' => self::factoryForModel(Mechanic::class),
            'name' => $this->faker->realText(30),
            'description' => $this->faker->realText(150),
            'status' => $status,
            'result' => $result,
            'price' => $price,
        ];
    }
}
