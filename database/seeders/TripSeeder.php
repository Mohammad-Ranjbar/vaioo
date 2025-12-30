<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TripSeeder extends Seeder
{
    public function run(): void
    {
        $trips = [
            [
                'representative_id' => 5,
                'source_airport_id' => 1,
                'destination_airport_id' => 2,
                'departure_date' => Carbon::now()->addDays(5)->setHour(8)->setMinute(0),
                'arrival_date' => Carbon::now()->addDays(5)->setHour(20)->setMinute(0),
                'capacity_weight' => 1500.50,
                'capacity_value' => 75000,
                'status' => 'planning',
            ],

            [
                'representative_id' => 5,
                'source_airport_id' => 3,
                'destination_airport_id' => 4,
                'departure_date' => Carbon::now()->subHours(2),
                'arrival_date' => Carbon::now()->addHours(8),
                'capacity_weight' => 2000.75,
                'capacity_value' => 120000,
                'status' => 'in_progress',
            ],

            [
                'representative_id' => 5,
                'source_airport_id' => 4,
                'destination_airport_id' => 1,
                'departure_date' => Carbon::now()->subDays(3)->setHour(14)->setMinute(30),
                'arrival_date' => Carbon::now()->subDays(3)->setHour(23)->setMinute(45),
                'capacity_weight' => 1800.25,
                'capacity_value' => 95000,
                'status' => 'planning',
            ],

            [
                'representative_id' => 4,
                'source_airport_id' => 2,
                'destination_airport_id' => 3,
                'departure_date' => Carbon::now()->addDays(10)->setHour(16)->setMinute(15),
                'arrival_date' => Carbon::now()->addDays(10)->setHour(22)->setMinute(30),
                'capacity_weight' => 2200.00,
                'capacity_value' => 150000,
                'status' => 'planning',
            ],

            [
                'representative_id' => 5,
                'source_airport_id' => 1,
                'destination_airport_id' => 3,
                'departure_date' => Carbon::now()->subHours(5),
                'arrival_date' => Carbon::now()->addHours(3),
                'capacity_weight' => 1900.80,
                'capacity_value' => 110000,
                'status' => 'in_progress',
            ],
        ];

        $trips = array_map(fn($trip) => array_merge($trip, [
            'created_at' => now(),
            'updated_at' => now(),
        ]),$trips);

        DB::table('trips')->insertOrIgnore($trips);

    }
}
