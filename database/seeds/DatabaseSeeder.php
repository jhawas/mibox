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
        // $this->call(UsersTableSeeder::class);
        
        factory(App\User::class)
	        ->create([
	            'first_name' => 'admin',
	            'middle_name' => 'admin',
	            'last_name' => 'admin',
	            'username' => 'admin',
	            'email' => 'admin@admin.com',
	            'email_verified_at' => now(),
	            'password' => bcrypt('admin')
	        ]);
    }
}
