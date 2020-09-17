<?php

namespace Database\Seeders;

use App\Models\Repair;
use App\Models\Tool;
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
        Tool::factory()->count(300)->create();
        Worklist::factory()->count(50)->create();
        Repair::factory()->count(100)->create();
    }
}
