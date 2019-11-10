<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'admin',
            'middle_name' => 'admin',
            'last_name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin')
        ]);

        $admin->roles()->attach(1);

        $nurse = User::create([
            'first_name' => 'ELLAINE KIM',
            'middle_name' => 'TENIO',
            'last_name' => 'HABABAG',
            'username' => 'nurse',
            'email' => 'nurse@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('nurse')
        ]);

        $nurse->roles()->attach(2);

        $doctor = User::create([
            'first_name' => 'JESUS',
            'middle_name' => 'MUICO',
            'last_name' => 'GAVIOLA',
            'username' => 'doctor',
            'email' => 'doctor@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('doctor')
        ]);

        $doctor->roles()->attach(3);

        $staff = User::create([
            'first_name' => 'RACID',
            'middle_name' => 'SELLOTE',
            'last_name' => 'SUBANGAN',
            'username' => 'staff',
            'email' => 'staff@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('staff')
        ]);

        $staff->roles()->attach(4);

        $billing = User::create([
            'first_name' => 'APRILL ANN',
            'middle_name' => 'P',
            'last_name' => 'POLENIO',
            'username' => 'billing',
            'email' => 'billing@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('billing')
        ]);

        $billing->roles()->attach(5);

        $billing2 = User::create([
            'first_name' => 'LENNY',
            'middle_name' => 'A',
            'last_name' => 'GANZON',
            'username' => 'lenny',
            'email' => 'billing2@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('lenny')
        ]);

        $billing2->roles()->attach([2, 5]);

        $billing3 = User::create([
            'first_name' => 'CHERRY MAE',
            'middle_name' => 'SALES',
            'last_name' => 'FLORES',
            'username' => 'cherry',
            'email' => 'billing3@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('cherry')
        ]);

        $billing3->roles()->attach([4, 5]);

    }
}
