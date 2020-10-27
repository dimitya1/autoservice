<?php

namespace Database\Factories;

use App\Models\Mechanic;
use App\Models\Repair;
use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class RepairFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Repair::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'request_id' => Request::factory(),
            'mechanic_id' => Mechanic::factory(),
            'result' => $this->faker->realText(150),
            'status' => rand(0, 1),
        ];
    }
}
