<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'case_no'  => $faker->uuid,
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'suffix' => $faker->suffix,
        'birthdate' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
        'religion' => 'catholic',
        'sex' => rand(0, 1) ? 'male' : 'female',
        'address' => $faker->address,
        'civil_status' => rand(0, 1) ? 'single' : 'married',
        'father' => $faker->name,
        'mother' => $faker->name,
        'spouse' => $faker->name,
        'spouse_address' => $faker->address,
        'contact_no' => $faker->phoneNumber,
        'e_name' => $faker->name,
        'e_contact' => $faker->phoneNumber,
        'e_address' => $faker->address,
        'created_at' => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now', $timezone = null),
        'user_id' => 1
    ];
});
