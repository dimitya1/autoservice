<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\Work;
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
        Work::factory()->count(100)->create();
    }
}
