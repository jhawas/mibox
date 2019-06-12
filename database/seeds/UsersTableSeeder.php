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
            'first_name' => 'nurse',
            'middle_name' => 'nurse',
            'last_name' => 'nurse',
            'username' => 'nurse',
            'email' => 'nurse@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('nurse')
        ]);

        $nurse->roles()->attach(2);

        $doctor = User::create([
            'first_name' => 'doctor',
            'middle_name' => 'doctor',
            'last_name' => 'doctor',
            'username' => 'doctor',
            'email' => 'doctor@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('doctor')
        ]);

        $doctor->roles()->attach(3);

        $staff = User::create([
            'first_name' => 'staff',
            'middle_name' => 'staff',
            'last_name' => 'staff',
            'username' => 'staff',
            'email' => 'staff@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('staff')
        ]);

        $staff->roles()->attach(4);

        $billing = User::create([
            'first_name' => 'billing',
            'middle_name' => 'billing',
            'last_name' => 'billing',
            'username' => 'billing',
            'email' => 'billing@ibox.com',
            'email_verified_at' => now(),
            'password' => bcrypt('billing')
        ]);

        $billing->roles()->attach(5);

    }
}
