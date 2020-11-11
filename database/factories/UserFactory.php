<?php

namespace Database\Factories;

use App\Models\User;
use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            'mobile_phone' => '+380' . rand(100000000, 999999999),
            'email_verified_at' => now(),
            'password' => '$2y$10$KGRRUfNzBhHA/olbc3/6OO8U7ifxihCiZRiL3YXjkApdlYAklXJMq', // Password1
            'remember_token' => Str::random(10),
            'is_admin' => 0,
        ];
    }
}
