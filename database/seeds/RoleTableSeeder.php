<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                'create-user' => true,
                'create-patient' => true,
                'update-patient' => true,
            ]
        ]);
        
        $nurse = Role::create([
            'name' => 'Nurse', 
            'slug' => 'nurse',
            'permissions' => [
                'create-patient' => true,
                'update-patient' => true,
            ]
        ]);
        
        $doctor = Role::create([
            'name' => 'Doctor', 
            'slug' => 'doctor',
            'permissions' => [
                'create-patient' => true,
                'update-patient' => true,
            ]
        ]);
    }
}
