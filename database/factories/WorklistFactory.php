<?php

namespace Database\Factories;

use App\Models\Worklist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WorklistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Worklist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(30),
            'price' => $this->faker->numberBetween(100, 30000),
        ];
    }
}
