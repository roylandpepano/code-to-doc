<?php

namespace Database\Seeders;

use App\Models\ActivityLogs;
use App\Models\TourOperator;
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
        $this->call([
            UserSeeder::class
        ]);

        $this->call([
            DestinationSeeder::class
        ]);

        $this->call([
            DestinationPackageSeeder::class
        ]);

        $this->call([
            DestinationActivitySeeder::class
        ]);

        $this->call([
            DestinationAmenitySeeder::class
        ]);

        $this->call([
            DestinationImageSeeder::class
        ]);

        $this->call([
            TourOperatorSeeder::class
        ]);

        $this->call([
            TourOperatorImageSeeder::class
        ]);

        $this->call([
            ActivityLogsSeeder::class
        ]);

        $this->call([
            PackageSeeder::class
        ]);

//        $this->call([
//            NotificationSeeder::class
//        ]);
    }
}
