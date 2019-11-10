<?php

use Illuminate\Database\Seeder;

class DiagnosesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$diagnoses = [
    		[
    			'name' => 'J11.1',
    			'description' => 'INFLUENZA',
    		],
    		[
    			'name' => 'N39.0',
    			'description' => 'UTI',
    		],
    		[
    			'name' => 'A97.1',
    			'description' => 'DENGUE FEVER',
    		],
    		[
    			'name' => 'A09.9;E86.1',
    			'description' => 'AGE WITH MOD DHN',
    		],
    		[
    			'name' => 'K27.9;E86.1',
    			'description' => 'ACUTE GASTRITIS WITH MOD DHN',
    		],
    		[
    			'name' => 'J18.92',
    			'description' => 'PCAP C MR/CAP MR',
    		],
    		[
    			'name' => 'J45.90',
    			'description' => 'BA IN AE',
    		],
    		[
    			'name' => 'L03.9',
    			'description' => 'CELLULITIS',
    		],
    		[
    			'name' => 'I10.9',
    			'description' => 'ESSENTIAL HYPERTENSION',
    		],
    		[
    			'name' => 'M19.09',
    			'description' => 'OSTEOARTHRITIS/ARTHRITIS',
    		],
    		[
    			'name' => '11402',
    			'description' => 'WOUND DEBRIDEMENT',
    		],
    		[
    			'name' => '12002',
    			'description' => 'WOUND SUTURING',
    		],
    		[
    			'name' => 'K29.8',
    			'description' => 'HYPOKALEMIA',
    		]
    	];

        $this->generateInitialData($diagnoses);
    }

    function generateInitialData($data) {
    	foreach ($data as $value) {
			DB::table('diagnoses')->insert([
	            'name' => $value['name'],
	            'description' => $value['description'],
	            'parent_id' => null,
	            'user_id' => 1
	        ]);
		}
    }
}
