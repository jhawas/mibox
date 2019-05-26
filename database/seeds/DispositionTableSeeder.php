<?php

use Illuminate\Database\Seeder;
use App\Disposition;

class DispositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dicharged = Disposition::create([
            'name' => 'Discharged',
        ]);

        $transfered = Disposition::create([
            'name' => 'Transfered',
        ]);

        $ama = Disposition::create([
            'name' => 'AMA',
        ]);

        $absconded = Disposition::create([
            'name' => 'Absconded',
        ]);
        
    }
}
