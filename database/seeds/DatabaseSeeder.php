<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(GroupOfChargeSeeder::class);

        $this->call(DispositionTableSeeder::class);
        $this->call(PhilhealthMembershipTableSeeder::class);
        $this->call(ResultTableSeeder::class);
        $this->call(TypeOfRecordTableSeeder::class);
        $this->call(DiscountTableSeeder::class);
        
        
        // intial data
        $this->call(InsurancesTableSeeder::class);
        $this->call(TypeOfChargesTableSeeder::class);
        $this->call(DiagnosesTableSeeder::class);
        $this->call(FloorTableSeeder::class);
        $this->call(RoomTableSeeder::class);

    }   
}
