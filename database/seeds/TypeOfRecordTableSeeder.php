<?php

use Illuminate\Database\Seeder;
use App\TypeOfRecord;

class TypeOfRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inPatient = TypeOfRecord::create([
            'name' => 'In Patient',
        ]);

        $outPatient = TypeOfRecord::create([
            'name' => 'Out Patient',
        ]);
    }
}
