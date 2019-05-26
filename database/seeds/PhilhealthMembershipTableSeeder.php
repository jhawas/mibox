<?php

use Illuminate\Database\Seeder;
use App\PhilhealthMembership;

class PhilhealthMembershipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employed = PhilhealthMembership::create([
            'name' => 'Employed',
        ]);

        $selfEmployed = PhilhealthMembership::create([
            'name' => 'Self Employed',
        ]);

        $lifetime = PhilhealthMembership::create([
            'name' => 'Lifetime(retires)',
        ]);

        $overseas = PhilhealthMembership::create([
            'name' => 'Overseas',
        ]);

        $sponsored = PhilhealthMembership::create([
            'name' => 'Sponsored',
        ]);

    }
}
