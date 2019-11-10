<?php

use Illuminate\Database\Seeder;
use App\Floor;

class FloorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groundFloor = Floor::create([
            'name' => 'Ground Floor',
            'user_id' => 1
        ]);
    }
}
