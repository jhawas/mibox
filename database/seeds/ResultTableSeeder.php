<?php

use Illuminate\Database\Seeder;
use App\Result;

class ResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recovered = Result::create([
            'name' => 'Recovered',
        ]);

        $improved = Result::create([
            'name' => 'Improved',
        ]);

        $unimproved = Result::create([
            'name' => 'Unimproved',
        ]);

        $died = Result::create([
            'name' => 'Died',
        ]);
    }
}
