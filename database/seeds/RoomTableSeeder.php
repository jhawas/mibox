<?php

use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/**
		* type of charges { 1 ward, 2 semi private, 3 private }
    	*/

        $rooms = [
        	[
        		'name' => 'Tuganay',
        		'description' => 'Ward',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 1,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Magsaysay',
        		'description' => 'Ward',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 1,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Ising',
        		'description' => 'Ward',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 1,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Asuncion',
        		'description' => 'Ward',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 1,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Sto. Nino',
        		'description' => 'Ward',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 1,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Lapaz',
        		'description' => 'Ward',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 1,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Alejal',
        		'description' => 'Semi-Private',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 2,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Treatment',
        		'description' => 'Private',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 3,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Mabuhay',
        		'description' => 'Private',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 3,
        		'user_id' => 1
        	],
        	[
        		'name' => 'Tobulao',
        		'description' => 'Private',
        		'capacity' => 5,
        		'floor_id' => 1,
        		'type_of_charge_id' => 3,
        		'user_id' => 1
        	]
        ];

        $this->generateInitialData($rooms);
    }

    function generateInitialData($data) {
    	foreach ($data as $value) {
			DB::table('rooms')->insert([
	            'name' => $value['name'],
	            'description' => $value['description'],
	            'capacity' => $value['capacity'],
	            'floor_id' => $value['floor_id'],
	            'type_of_charge_id' => $value['type_of_charge_id'],
	            'user_id' => $value['user_id'],
	        ]);
		}
    }
}
