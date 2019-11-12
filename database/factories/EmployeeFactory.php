<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use App\Company;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_id' => factory(Company::class),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->e164PhoneNumber,
    ];
});