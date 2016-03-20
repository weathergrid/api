<?php

use Illuminate\Database\Seeder;

class NodesTableSeeder extends Seeder
{
    /**
     * Seed the nodes table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nodes')->insert([
        	[
	        	'ip' => '127.0.0.1',
	        	'name' => 'A Node Near You',
	        	'description' => 'Your "local" node, sponsored by a store near you.',
	        	'MOTD' => 'your average motd',
	        	'region' => 'Puerto Rico',
	        	'timezone' => 'Americas/Puerto_Rico',
	        	'latitude' => '18.4500',
	        	'longitude' => '66.1000'
        	],
        	[
	        	'ip' => '8.8.8.8',
	        	'name' => 'A Node Far From You',
	        	'description' => 'Actually Google Public DNS',
	        	'MOTD' => 'your average motd',
	        	'region' => 'California',
	        	'timezone' => 'America/Los_Angeles',
	        	'latitude' => '37.3894',
	        	'longitude' => '122.0819'
        	]
        ]);
    }
}
