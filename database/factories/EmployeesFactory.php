<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Employees;

$factory->define(Employees::class, function (Faker $faker) {
    return [
        'first_name' =>$faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'phone' => rand(1111111111,9999999999),
    ];
});
