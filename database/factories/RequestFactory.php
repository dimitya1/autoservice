<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => self::factoryForModel(User::class),
            'car_id' => self::factoryForModel(Car::class),
            'description' => $this->faker->realText(150),
            'status' => rand(0, 1),
        ];
    }
}