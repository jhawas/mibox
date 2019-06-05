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

        $medicationAndTreatment = Type::create([
            'name' => 'Medication And Treatment', 
            'slug' => 'Medication And Treatment',
            'description' => 'Medication And Treatment',
        ]);

        $room = Type::create([
            'name' => 'room', 
            'slug' => 'room',
            'description' => 'room',
        ]);

        $intravenousFluid = Type::create([
            'name' => 'Intravenous Fluid', 
            'slug' => 'Intravenous Fluid',
            'description' => 'Intravenous Fluid',
        ]);

        $others = Type::create([
            'name' => 'Others', 
            'slug' => 'Others',
            'description' => 'Others',
        ]);
    }
}
