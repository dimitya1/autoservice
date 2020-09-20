<?php

namespace Database\Factories;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ToolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tool::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));

        return [
            'name' => $this->faker->randomElement($this->faker->vehicleProperties) ?? $this->faker->realText(10),
            'description' => $this->faker->realText(rand(10, 100)),
            'quantity' => rand(1, 100),
        ];
    }
}
