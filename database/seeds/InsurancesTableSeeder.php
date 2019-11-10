<?php

use Illuminate\Database\Seeder;
use App\Insurance;

class InsurancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $philhealth = Insurance::create([
            'name' => 'Philhealth', 
            'user_id' => 1,
        ]);

        $maxicare = Insurance::create([
            'name' => 'Maxicare', 
            'user_id' => 1,
        ]);

        $intellicare = Insurance::create([
            'name' => 'Intellicare', 
            'user_id' => 1,
        ]);
    }
}
