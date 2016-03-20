<?php

use Illuminate\Database\Seeder;

class HourlyTableSeeder extends Seeder
{
    /**
     * Seed the hourly archival table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hourly')->insert([
            [
                'node_id' => 1,
                'temperature' => 60,
                'pressure' => 14,
                'humidity' => 40
            ],
            [
                'node_id' => 2,
                'temperature' => 34,
                'pressure' => 12,
                'humidity' => 15
            ]
        ]);
    }
}
