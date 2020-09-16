<?php

namespace Database\Factories;

use App\Models\Mechanic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MechanicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mechanic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'mobile_phone' => $this->faker->e164PhoneNumber,
            'status' => rand(0, 1),
        ];
    }
}
