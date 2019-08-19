<?php

use Illuminate\Database\Seeder;
use App\GroupOfCharge;

class GroupOfChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laboratory = GroupOfCharge::create([
            'name' => 'laboratory',
        ]);

        $medicine = GroupOfCharge::create([
            'name' => 'medicine',
        ]);

        $supplies = GroupOfCharge::create([
            'name' => 'supplies',
        ]);
    }
}
