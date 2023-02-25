<?php

namespace Database\Seeders;

use App\Models\ActivityLogs;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class ActivityLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityLogs::factory()->count(10)->create();
    }
}
