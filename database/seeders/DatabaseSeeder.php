<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Mechanic;
use App\Models\Repair;
use App\Models\Request;
use App\Models\Tool;
use App\Models\User;
use App\Models\Worklist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $mechanics = Mechanic::factory()->count(10)->create();
        $worklists = Worklist::factory()->count(156)->create();
        $tools = Tool::factory()->count(250)->create();
        $mechanicIds = $mechanics->pluck('id');

        User::factory()->count(50)->create()->each(function ($user) use ($tools, $mechanicIds, $worklists) {
            $cars = Car::factory()->count(rand(1, 3))->create(['user_id' => $user->id]);
            $cars->shuffle();
            $shuffledCarsIds = $cars->pluck('id');
            $requests = Request::factory()->count(rand(1, 2))
                ->create(['user_id' => $user->id, 'car_id' => $shuffledCarsIds->random()])
                ->each(function ($request) use ($tools, $mechanicIds, $worklists) {
                    $randRequestWorklist = rand(1, 5);
                    $request->worklists()->attach($worklists->pluck('id')->random($randRequestWorklist));
                    $repairs = Repair::factory()->count($randRequestWorklist)->create(
                        ['request_id' => $request->id, 'mechanic_id' => $mechanicIds->random(), 'status' => $request->status]
                    )->each(function ($repair) use ($tools) {
                        $repair->tools()->attach($tools->pluck('id')->random(rand(1, 10)), ['used_quantity' => rand(0, 15)]);
                    });
                });
        });
    }
}
