<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laboratory = Type::create([
            'name' => 'laboratory', 
            'slug' => 'laboratory',
            'description' => 'laboratory',
        ]);

        $medicine = Type::create([
            'name' => 'medicine', 
            'slug' => 'medicine',
            'description' => 'medicine',
        ]);

        $room = Type::create([
            'name' => 'room', 
            'slug' => 'room',
            'description' => 'room',
        ]);

        $others = Type::create([
            'name' => 'others', 
            'slug' => 'others',
            'description' => 'others',
        ]);
    }
}
