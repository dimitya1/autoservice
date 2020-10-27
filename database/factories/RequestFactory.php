<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
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
            'user_id' => User::factory(),
            'car_id' => Car::factory(),
            'description' => $this->faker->realText(150),
            'status' => rand(0, 1),
            'date' => Carbon::now()->addDays(rand(1, 3))->setHour(8)->minute(0)->second(0),
        ];
    }
}
